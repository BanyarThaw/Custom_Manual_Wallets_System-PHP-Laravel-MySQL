<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Exports\WithdrawalExport;
use Maatwebsite\Excel\Facades\Excel;

class WithdrawalController extends Controller
{
    public function index() {
        $withdrawals = Withdrawal::where('status','=',0)->orderBy('created_at','desc')->paginate(10);

        return view('withdrawals.index',compact('withdrawals'));
    }

    public function excel_download_form($status) {
        $type ="Withdrawal";
        $status = ($status == 0) ? "Pending Requests" : (($status == 1)  ? "Approved Requests" : "Rejected Requests");

        return view('withdrawals.download',compact('status','type'));
    }

    public function excel_export(Request $request) {
        if($request->status == 'Pending Requests') {
            return Excel::download(new WithdrawalExport($request->from_date,$request->to_date,0), $request->from_date.'-'.$request->to_date.'pending_withdrawal_list.xlsx');
        }

        if($request->status == 'Approved Requests') {
            return Excel::download(new WithdrawalExport($request->from_date,$request->to_date,1), $request->from_date.'-'.$request->to_date.'approved_withdrawal_list.xlsx');
        }

        if($request->status == 'Rejected Requests') {
            return Excel::download(new WithdrawalExport($request->from_date,$request->to_date,2), $request->from_date.'-'.$request->to_date.'rejected_withdrawal_list.xlsx');
        }
    }

    public function approve($id) {
        $withdrawal = Withdrawal::findOrFail($id);

        $withdrawal->status = 1; // 0 = pending state, 1 = approve, 2 = reject 
        $withdrawal->save();

        return redirect()->back()->with('info','Withdrawal approved.');
    }

    public function approve_list() {
        $withdrawals = Withdrawal::where('status','=',1)->orderBy('created_at','desc')->paginate(10);

        return view('withdrawals.approve',compact('withdrawals'));
    }

    public function reject($id) {
        $withdrawal = Withdrawal::findOrFail($id);

        $withdrawal->status = 2; // 0 = pending state, 1 = approve, 2 = reject
        $withdrawal->save();

        return redirect()->back()->with('info','Withdrawal rejected.');
    }

    public function reject_list() {
        $withdrawals = Withdrawal::where('status','=',2)->orderBy('created_at','desc')->paginate(10);

        return view('withdrawals.reject',compact('withdrawals'));
    }
}
