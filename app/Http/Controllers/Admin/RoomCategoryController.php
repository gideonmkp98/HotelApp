<?php

namespace App\Http\Controllers\admin;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(RoomCategory::select('*'))
                ->addColumn('action', 'admin.roomcategory.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.roomcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roomcategory.create');
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
            'name' => 'required',
            'price' => 'required',
        ]);
        $roomcategory = new RoomCategory;
        $roomcategory->name = $request->name;
        $roomcategory->price = $request->price;
        $roomcategory->save();
        return redirect()->route('room-category.index')
            ->with('success','Company has been created successfully.');
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
    public function edit(Roomcategory $roomCategory)
    {
        return view('admin.roomcategory.edit',compact('roomCategory'));
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
            'name' => 'required',
            'price' => 'required'
        ]);
        $roomCategory = RoomCategory::find($id);
        $roomCategory->name = $request->name;
        $roomCategory->price = $request->price;
        $roomCategory->save();

        return redirect()->route('room-category.index')
            ->with('success', 'Room Category Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rc = RoomCategory::where('id',$request->id)->delete();
        return Response()->json($rc);
    }
}
