<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

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
        // return $user;
        return view("/member.memberInfo",compact("user"));
    }
    
    
}