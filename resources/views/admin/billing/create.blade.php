@extends('layouts.adminapp')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Make new Bill</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('billings.index') }}" enctype="multipart/form-data"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('billings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User:</strong>
                        <select class="form-control" name="reservation_id" id="user">
                            @foreach($reservations as $reservation)
                                <option value="{{$reservation->id}}">Reservation - {{$reservation->id}}</option>
                            @endforeach
                        </select>
                        @error('reservation_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Room charge:</strong>
                                <input type="text" name="room_charge" class="form-control" placeholder="Room Charge">
                                @error('room_charge')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <strong>Payed:</strong>
                                <select class="form-control" name="is_payed" id="is_payed">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('is_payed')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <strong>Credit Card:</strong>
                                <select class="form-control" name="credit_card" id="Credit Card">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('credit_card')
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
