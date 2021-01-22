<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Reservation;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Billing::select('*'))
                ->addColumn('action', 'admin.billing.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.billing.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservations = Reservation::all();
        $billings = Billing::all();
        return view('admin.billing.create', compact('billings', 'reservations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required',
            'room_charge' => 'required',
            'is_payed' => 'required',
            'credit_card' => 'required',
        ]);

        $billing = new Billing;
        $billing->reservation_id = $request->reservation_id;
        $billing->room_charge = $request->room_charge;
        $billing->is_payed = $request->is_payed;
        $billing->credit_card = $request->credit_card;
        $billing->save();

        return redirect()->route('billings.index')
            ->with('success','Bill is added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Billing $billing)
    {
        return view('admin.billing.show',compact('billing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Billing $billing)
    {
        $reservations = Reservation::all();
        return view('admin.billing.edit',compact('billing','reservations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'reservation_id' => 'required',
            'room_charge' => 'required',
            'is_payed' => 'required',
            'credit_card' => 'required',
        ]);

        $billing = Billing::find($id);
        $billing->reservation_id = $request->guest_id;
        $billing->room_charge = $request->room_charge;
        $billing->is_payed = $request->is_payed;
        $billing->credit_card = $request->credit_card;
        $billing->save();

        return redirect()->route('billings.index')
            ->with('success', 'Bill is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $billing =  Billing::where('id',$request->id)->delete();
        return Response()->json($billing);
    }
}
