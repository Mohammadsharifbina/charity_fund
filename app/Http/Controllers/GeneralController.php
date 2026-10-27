<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Entery;
use App\Models\Withdraw;
use Carbon\Carbon;

class GeneralController extends Controller
{
    public function index(){
        
        $user=Member::all();
    }
    public function deleteMember($id){
       
        $member = Member::find($id);
        $member->delete();
        return redirect()->back();
    }
    public function memberInfo($id){
        $user=Member::find($id);
        $totalAmount=Entery::where('member_id',$id)->sum('amount');
       $thisMonth = Entery::where('member_id', $id)
    ->whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->sum('amount');;
        $Deposit=Withdraw::where('member_id',$id)->sum('amount');
    
        return view("/member.memberInfo",compact("user","totalAmount" ,"Deposit","thisMonth"));
    }
    
    
}