<?php

namespace App\Exports;

use App\Models\Withdrawal;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class WithdrawalExport implements FromCollection,WithHeadings,WithColumnWidths
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

        $withdrawals = Withdrawal::where('status','=',$this->status)->whereBetween('created_at',[$from,$to])
            ->orderBy('created_at','desc')
            ->get();

        $withdrawals_array = array();
        foreach($withdrawals as $withdrawal) {
            $withdrawal = [
                'Date' => $withdrawal->created_at->format('d-m-Y'),
                'User Id' => $withdrawal->user_id,
                'User Account' => $withdrawal->user_account,
                'Payment' => $withdrawal->payment->bank,
                'Amount' => $withdrawal->amount.'MMK',
                'Total Points' => $withdrawal->total_points,
                'Point Value' => $withdrawal->point_value.'MMK',
            ];
            array_push($withdrawals_array,$withdrawal);
        }
        
        return collect($withdrawals_array);
    }

    public function headings(): array
    {
        return [
            'Date',
            'User Id',
            'User Account',
            'Payment',
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