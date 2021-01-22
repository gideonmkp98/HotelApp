<?php

namespace App\Http\Controllers\admin;

use App\Models\Reservation;
use App\Models\Guest;
use App\Models\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->ajax()) {
            return datatables()->of(Reservation::select('*'))
                ->addColumn('action', 'admin.reservation.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.reservation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::all();
        $guests = Guest::all();
        return view('admin.reservation.create', compact('guests', 'rooms'));
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
            'guest_id' => 'required',
            'room_id' => 'required',
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'accepted' => 'required',
            'number_of_guests' => 'required',
        ]);

        $check_in = new \DateTime($request['check_in_date']);
        $check_out = new \DateTime($request['check_out_date']);

        $reservation = new Reservation;
        $reservation->guest_id = $request->guest_id;
        $reservation->room_id = $request->room_id;
        $reservation->check_in_date = $check_in;
        $reservation->check_out_date = $check_out;
        $reservation->accepted = $request->accepted;
        $reservation->number_of_guests = $request->number_of_guests;
        $reservation->save();

        return redirect()->route('reservations.index')
            ->with('success','Reservation is added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return view('admin.reservation.show',compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $guests = Guest::all();
        return view('admin.reservation.edit',compact('reservation', 'guests'));
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
            'guest_id' => 'required',
            'room_id' => 'required',
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'accepted' => 'required',
            'number_of_guests' => 'required',
        ]);

        $check_in = new \DateTime($request['check_in_date']);
        $check_out = new \DateTime($request['check_out_date']);

        $reservation = Reservation::find($id);
        $reservation->guest_id = $request->guest_id;
        $reservation->room_id = $request->room_id;
        $reservation->check_in_date = $check_in;
        $reservation->check_out_date = $check_out;
        $reservation->accepted = $request->accepted;
        $reservation->number_of_guests = $request->number_of_guests;
        $reservation->save();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $reservation = Reservation::where('id',$request->id)->delete();
        return Response()->json($reservation);
    }
}
