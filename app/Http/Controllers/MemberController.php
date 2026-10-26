<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members=Member::all();
        return view("member",compact("members"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("member.addmember");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $members= new Member();
        $members->name=$request->name;
        $members->last_name=$request->last_name;
        $members->phone=$request->phone;
     $members->status=$request->status;
        if($request->hasfile("image")){
            $file = $request->file("image");
            
            $extension = $file->getClientOriginalExtension();
            $name=time().".".$extension;
            $file=$file->move("students/", $name);
            $members->image = $name;
        }
        $members->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $members=Member::find($id);
        return view("member.editMember",compact("members"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $members=Member::find($id);
           $members->name=$request->name;
        $members->last_name=$request->last_name;
        $members->phone=$request->phone;
     $members->status=$request->status;
        if($request->hasfile("image")){
            $file = $request->file("image");
            
            $extension = $file->getClientOriginalExtension();
            $name=time().".".$extension;
            $file=$file->move("students/", $name);
            $members->image = $name;
        }
        $members->save();
        return redirect("member");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member=Member::find($id);
        $member->delete();
        return redirect()->back();
    }
}