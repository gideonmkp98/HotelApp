@extends('layouts.adminapp')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add Guest</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary mb-4" href="{{ route('reservations.index') }}" enctype="multipart/form-data"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('reservations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Guest:</strong>
                        <select class="form-control" name="guest_id" id="guest">
                            <option value="" >Select Guest</option>
                            @foreach($guests as $guest)
                                <option value="{{$guest->id}}">{{$guest->firstname}} @if ($guest->middlename){{$guest->middlename}}@endif {{$guest->lastname}}</option>
                            @endforeach
                        </select>
                        @error('guest_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Room:</strong>
                                <select class="form-control" name="room_id" id="guest">
                                    <option value="" >Select Room</option>
                                    @foreach($rooms as $room)
                                        <option value="{{$room->id}}">Room {{$room->id}}</option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <strong>Check in date:</strong>
                                <input type="text" name="check_in_date" class="date form-control">
                                @error('check_in_date')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <strong>Check out date:</strong>
                                <input type="text" name="check_out_date" class="date form-control">
                                @error('check_out_date')
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
                                <strong>Guests:</strong>
                                <select class="form-control" name="number_of_guests" id="number_of_guests">
                                    <?php $maxGuests = 11 ?>
                                    @for ($i = 1; $i < $maxGuests; $i++)
                                        <option value='{{$i}}' >{{$i}}</option>
                                    @endfor
                                </select>
                                @error('number_of_guests')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <strong>Reservation Accepted:</strong>
                                <select class="form-control" name="accepted" id="accepted">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('accepted')
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
