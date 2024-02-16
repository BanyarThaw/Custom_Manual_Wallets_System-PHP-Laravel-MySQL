<?php

namespace App\Exports;

use App\Models\Deposit;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class DepositExport implements FromCollection,WithHeadings,WithColumnWidths
{
    private $from_date,$to_date,$status;

    public function __construct(string $from_date,string $end_date,int $status)
    {
        $this->from_date = $from_date;
        $this->to_date = $end_date;
        $this->status = $status;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $from = Carbon::parse($this->from_date)->format('Y-m-d 00:00:00');
        $to = Carbon::parse($this->to_date)->format('Y-m-d 23:59:59');

        $deposits = Deposit::where('status','=',$this->status)->whereBetween('created_at',[$from,$to])
            ->orderBy('created_at','desc')
            ->get();

        $deposits_array = array();
        foreach($deposits as $deposit) {
            $deposit = [
                'Date' => $deposit->created_at->format('d-m-Y'),
                'User Id' => $deposit->user_id,
                'Bank Account Number Or Phone Number' => $deposit->user_account,
                'Payment' => $deposit->payment->bank,
                'Amount' => $deposit->amount.'MMK',
                'Total Points' => $deposit->total_points,
                'Point Value' => $deposit->point_value.'MMK'
            ];
            array_push($deposits_array,$deposit);
        }
        
        return collect($deposits_array);
    }

    public function headings(): array
    {
        return [
            'Date',
            'User Id',
            'User Account',
            'Payment Id',
            'Amount',
            'Total Points',
            'Point Value'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,        
            'C' => 20,
            'D' => 20,    
            'E' => 20,    
            'F' => 20,
            'G' => 20,
            'H' => 20, 
        ];
    }   
}