<?php

namespace App\Http\Controllers\admin;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Room::select('*'))
                ->addColumn('action', 'admin.room.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.room.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roomCategories = RoomCategory::all();
        return view('admin.room.create', compact('roomCategories'));
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
            'room_type' => 'required',
            'number_of_beds' => 'required',
        ]);
        $room = new Room;
        $room->room_type = $request->room_type;
        $room->number_of_beds = $request->number_of_beds;
        $room->save();
        return redirect()->route('rooms.index')
            ->with('success','Room has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $roomCategories = RoomCategory::all();
        return view('admin.room.edit',compact('room', 'roomCategories'));
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
            'room_type' => 'required',
            'number_of_beds' => 'required',
        ]);
        $room = Room::find($id);
        $room->room_type = $request->room_type;
        $room->number_of_beds = $request->number_of_beds;
        $room->save();

        return redirect()->route('rooms.index')
            ->with('success', 'Room Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $room = Room::where('id',$request->id)->delete();
        return Response()->json($room);
    }
}
