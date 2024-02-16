<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Exports\DepositExport;
use Maatwebsite\Excel\Facades\Excel;

class DepositController extends Controller
{
    public function index() {
        $deposits = Deposit::where('status','=',0)->orderBy('created_at','desc')->paginate(10);

        return view('deposits.index',compact('deposits'));
    }

    public function approve($id) {
        $deposit = Deposit::findOrFail($id);

        $deposit->status = 1; // 0 = pending state, 1 = approve, 2 = reject 
        $deposit->save();

        return redirect()->back()->with('info','Deposit approved.');
    }

    public function approve_list() {
        $deposits = Deposit::where('status','=',1)->orderBy('created_at','desc')->paginate(10);

        return view('deposits.approve',compact('deposits'));
    }

    public function excel_download_form($status) {
        $type = 'Deposit';
        $status = ($status == 0) ? "Pending Requests" : (($status == 1)  ? "Approved Requests" : "Rejected Requests");

        return view('deposits.download',compact('status','type'));
    }

    public function excel_export(Request $request) {
        if($request->status == 'Pending Requests') {
            return Excel::download(new DepositExport($request->from_date,$request->to_date,0), $request->from_date.'-'.$request->to_date.'pending_deposit_list.xlsx');
        }

        if($request->status == 'Approved Requests') {
            return Excel::download(new DepositExport($request->from_date,$request->to_date,1), $request->from_date.'-'.$request->to_date.'approved_deposit_list.xlsx');
        }

        if($request->status == 'Rejected Requests') {
            return Excel::download(new DepositExport($request->from_date,$request->to_date,2), $request->from_date.'-'.$request->to_date.'rejected_deposit_list.xlsx');
        }
    }

    public function reject($id) {
        $deposit = Deposit::findOrFail($id);

        $deposit->status = 2; // 0 = pending state, 1 = approve, 2 = reject
        $deposit->save();

        return redirect()->back()->with('info','Deposit rejected.');
    }

    public function reject_list() {
        $deposits = Deposit::where('status','=',2)->orderBy('created_at','desc')->paginate(10);

        return view('deposits.reject',compact('deposits'));
    }

    public function photo(Request $request,$id) {
        if($request->ajax()) {
            $deposit = Deposit::findOrFail($id);

            return view('deposits.photo',compact('deposit'));
        } 
        return redirect()->route('payments.index');
    }
}
