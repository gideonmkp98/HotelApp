@extends('layouts.adminapp')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>Guest - {{$guest->firstname}} @if($guest->middlename) {{$guest->middlename}} @endif {{$guest->lastname}}</h2>
                </div>
                <div class="pull-right mt-2">
                    <a class="btn btn-primary" href="{{ route('guests.index') }}" enctype="multipart/form-data"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User:</strong>
                        <select class="form-control" name="user" id="user" readonly="" disabled>
                                <option value="{{$guest->user->id}}" >{{$guest->user->email}}</option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Firstname:</strong>
                                <input type="text" name="firstname" value="{{ $guest->firstname }}" class="form-control" disabled>
                            </div>
                            <div class="col-sm-4">
                                <strong>Middle Name:</strong>
                                <input type="text" name="middlename" value="{{ $guest->middlename }}" class="form-control" disabled>
                            </div>
                            <div class="col-sm-4">
                                <strong>Lastname:</strong>
                                <input type="text" name="lastname" value="{{ $guest->lastname }}" class="form-control" disabled>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date of birth:</strong>
                        <input id="date_of_birth" type="text" class="date form-control" name="date_of_birth" value="{{$guest->date_of_birth->format('d-m-Y')}}"  disabled>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <strong>Street name:</strong>
                                <input type="text" name="streetname" value="{{ $guest->streetname }}" class="form-control" disabled>
                            </div>
                            <div class="col-sm-3">
                                <strong>Postal Code:</strong>
                                <input type="text" name="postal_code" value="{{ $guest->postal_code }}" class="form-control" disabled>
                            </div>
                            <div class="col-sm-3">
                                <strong>City:</strong>
                                <input type="text" name="city" value="{{ $guest->city }}" class="form-control" disabled>
                            </div>
                            <div class="col-sm-3">
                                <strong>Country:</strong>
                                <input type="text" name="country" value="{{ $guest->country }}" class="form-control" disabled>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Phone number:</strong>
                                <input type="number" name="phone" value="{{ $guest->phone }}" class="form-control" disabled>
                            </div>
                            <div class="col-sm-6">
                                <strong>Active:</strong>
                                <select class="form-control" name="active" id="active" disabled>
                                    <option value='1' @if ($guest->active == 1) selected @endif>Yes</option>
                                    <option value='0' @if ($guest->active == 0) selected @endif>No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </body>
@endsection
