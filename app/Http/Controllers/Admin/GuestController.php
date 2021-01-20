<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guest;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Guest::select('*'))
                ->addColumn('action', 'admin.guest.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.guest.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.guest.create', compact('users'));
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
            'user' => 'nullable',
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'date_of_birth' => 'required',
            'phone' => 'required',
            'streetname' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'country' => 'required',
            'active' => 'required',
        ]);

        $dob = new \DateTime($request['date_of_birth']);

        $guest = new Guest;
        $guest->user = $request->user;
        $guest->firstname = $request->firstname;
        $guest->middlename = $request->middlename;
        $guest->lastname = $request->lastname;
        $guest->date_of_birth = $dob->format('Y-m-d');
        $guest->phone = $request->phone;
        $guest->streetname = $request->streetname;
        $guest->postal_code = $request->postal_code;
        $guest->city = $request->city;
        $guest->country = $request->country;
        $guest->active = $request->active === 'true' ? true: false;
        $guest->save();

        return redirect()->route('guests.index')
            ->with('success','Guest has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guest $guest)
    {
        return view('admin.guest.view',compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        $users = User::all();
        return view('admin.guest.edit',compact('guest', 'users'));
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
            'user' => 'nullable',
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'date_of_birth' => 'required',
            'phone' => 'required',
            'streetname' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'country' => 'required',
            'active' => 'required',
        ]);

        $dob = new \DateTime($request['date_of_birth']);

        $guest = Guest::find($id);
        $guest->user = $request->user;
        $guest->firstname = $request->firstname;
        $guest->middlename = $request->middlename;
        $guest->lastname = $request->lastname;
        $guest->date_of_birth = $dob->format('Y-m-d');
        $guest->phone = $request->phone;
        $guest->streetname = $request->streetname;
        $guest->postal_code = $request->postal_code;
        $guest->city = $request->city;
        $guest->country = $request->country;
        $guest->active = $request->active === 'true' ? true: false;

        $guest->save();

        return redirect()->route('guests.index')
            ->with('success', 'Guest Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $guest = Guest::where('id',$request->id)->delete();
        return Response()->json($guest);
    }
}
