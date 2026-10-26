<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\Member;
class withdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $withdraws=Withdraw::all();
        return view("withdraw.withdraw",compact("withdraws"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members=Member::all();
        return view("withdraw.NewWithdraw",compact("members"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $withdraw=new Withdraw();
        $withdraw->member_id=$request->member_id;
    $withdraw->amount=$request->amount;
    $withdraw->save();
   return redirect("/memberInfo/$request->member_id");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member=Member::find($id);
         return view("withdraw.NewWithdraw",compact("member"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $WD=Withdraw::find($id);
        $WD->delete();
        return redirect()->back();
    }
}