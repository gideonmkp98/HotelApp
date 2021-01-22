@extends('layouts.adminapp')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Reservation - {{$reservation->id}}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('reservations.index') }}" enctype="multipart/form-data"> Back</a>
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
                        <strong>Guest:</strong>
                        <select class="form-control" name="guest_id" id="guest" disabled>
                                <option value="{{$reservation->guest_id}}">{{$reservation->guest->firstname}} @if ($reservation->guest->middlename){{$reservation->guest->middlename}}@endif {{$reservation->guest->lastname}}</option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Room:</strong>
                                <input type="text" name="room_id" value="{{ $reservation->room_id }}" class="form-control" placeholder="Room" disabled>
                            </div>
                            <div class="col-sm-4">
                                <strong>Check in date:</strong>
                                <input type="text" name="check_in_date" value="{{$reservation->check_in_date->format('d-m-Y')}}" class="date form-control" disabled>
                            </div>
                            <div class="col-sm-4">
                                <strong>Check out date:</strong>
                                <input type="text" name="check_out_date" value="{{$reservation->check_out_date->format('d-m-Y')}}" class="date form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Guests:</strong>
                                <select class="form-control" name="number_of_guests" id="number_of_guests" disabled>
                                    <option value='{{$reservation->number_of_guests}}'>{{$reservation->number_of_guests}}</option>
                                </select>

                            </div>
                            <div class="col-sm-6">
                                <strong>Reservation Accepted:</strong>
                                <select class="form-control" name="accepted" id="accepted" disabled>
                                    <option value="{{$reservation->accepted}}">@if($reservation->accepted) Yes @else No @endif</option>
                                </select>
                                @error('accepted')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
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
