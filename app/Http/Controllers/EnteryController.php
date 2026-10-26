<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entery;
use App\Models\Member;
use Morilog\Jalali\Jalalian;
use Morilog\Jalali\CalendarUtils;
use Carbon\Carbon;

class EnteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $enteries=Entery::all();
        return view("entery.enteries",compact("enteries"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
$jalali = \Morilog\Jalali\Jalalian::now();

$year = $jalali->getYear();
$month = $jalali->getMonth();

[$gy, $gm, $gd] =
    \Morilog\Jalali\CalendarUtils::toGregorian(
        $year, $month, 1
    );

$start = \Carbon\Carbon::create(
    $gy, $gm, $gd, 0, 0, 0
);

if ($month == 12) {
    $nextYear = $year + 1;
    $nextMonth = 1;
} else {
    $nextYear = $year;
    $nextMonth = $month + 1;
}

[$ny, $nm, $nd] =
    \Morilog\Jalali\CalendarUtils::toGregorian(
        $nextYear, $nextMonth, 1
    );

$end = \Carbon\Carbon::create(
    $ny, $nm, $nd, 0, 0, 0
);

$monthlyEntries = \App\Models\Entery::where(
    'created_at', '>=', $start
)
    ->where('created_at', '<', $end)
    ->get()
    ->keyBy('member_id');

$members = \App\Models\Member::all();

return view('entery.newEntery', compact(
    'members',
    'monthlyEntries'
));

    }

    /**
     * Store a newly created resource in storage.
     */
   

public function store(Request $request)
{
    $request->validate([
        'member_id' => 'required|exists:members,id',
        'amount' => 'required|numeric|min:1',
    ]);

    // د روانې هجري شمسي میاشتې کال او میاشت
    $jalali = Jalalian::now();

    $year = $jalali->getYear();
    $month = $jalali->getMonth();

    // د روانې شمسي میاشتې لومړۍ ورځ
    [$gy, $gm, $gd] = CalendarUtils::toGregorian(
        $year,
        $month,
        1
    );

    $start = Carbon::create(
        $gy, $gm, $gd, 0, 0, 0
    );

    // د راتلونکې شمسي میاشتې لومړۍ ورځ
    if ($month == 12) {
        $nextYear = $year + 1;
        $nextMonth = 1;
    } else {
        $nextYear = $year;
        $nextMonth = $month + 1;
    }

    [$ny, $nm, $nd] = CalendarUtils::toGregorian(
        $nextYear,
        $nextMonth,
        1
    );

    $end = Carbon::create(
        $ny, $nm, $nd, 0, 0, 0
    );

    // وګوره چې دې غړي په روانه شمسي میاشت کې انتري کړې که نه
    $existingEntry = Entery::where(
        'member_id',
        $request->member_id
    )
        ->where('created_at', '>=', $start)
        ->where('created_at', '<', $end)
        ->first();

    if ($existingEntry) {
        return redirect()->back()
            ->with('error', 'دې نفر په روانه هجري شمسي میاشت کې انتري کړې ده.');
    }

    // نوې انتري ثبتول
    $entery = new Entery();
    $entery->member_id = $request->member_id;
    $entery->amount = $request->amount;
    $entery->save();

    return redirect()->back()
        ->with('success', 'انتري په بریالیتوب ثبت شوه.');
}



    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entry=Entery::find($id);
        
        $entry->delete();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment=Entery::find($id);
        return $payment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
            $entery=Entery::find($id);
        $entery->member_id=$request->member_id;
        $entery->amount=$request->amount;
        $entery->save();
        return redirect('Entery')->with('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}