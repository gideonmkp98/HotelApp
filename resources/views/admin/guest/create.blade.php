@extends('layouts.adminapp')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add Guest</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary mb-4" href="{{ route('guests.index') }}" enctype="multipart/form-data"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('guests.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User:</strong>
                        <select class="form-control" name="user" id="user">
                            <option value="">-- Not Selected --</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->email}}</option>
                            @endforeach
                        </select>
                        @error('room_type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Firstname:</strong>
                                <input type="text" name="firstname" class="form-control" placeholder="Firstname">
                                @error('firstname')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <strong>Middle Name:</strong>
                                <input type="text" name="middlename" class="form-control" placeholder="Middle Name">
                                @error('middlename')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <strong>Lastname:</strong>
                                <input type="text" name="lastname" class="form-control" placeholder="lastname">
                                @error('lastname')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date of birth:</strong>
                        <input id="date_of_birth" type="text" class="date form-control" name="date_of_birth" required >
                        @error('date_of_birth')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <strong>Street name:</strong>
                                <input type="text" name="streetname" class="form-control" placeholder="Street name">
                                @error('streetname')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <strong>Postal Code:</strong>
                                <input type="text" name="postal_code" class="form-control" placeholder="Postal code">
                                @error('postal_code')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <strong>City:</strong>
                                <input type="text" name="city" class="form-control" placeholder="City">
                                @error('city')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <strong>Country:</strong>
                                <input type="text" name="country" class="form-control" placeholder="Country">
                                @error('country')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Phone number:</strong>
                                <input type="number" name="phone" class="form-control" placeholder="Phone Number">
                                @error('phone')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <strong>Active:</strong>
                                <select class="form-control" name="active" id="active">
                                    <option value='1' >Yes</option>
                                    <option value='0' >No</option>
                                </select>
                                @error('middlename')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary ml-3">Create</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $('.date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });
    </script>
    </body>
@endsection
