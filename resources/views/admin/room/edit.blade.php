@extends('layouts.adminapp')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Room</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('rooms.index') }}" enctype="multipart/form-data"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('rooms.update',$room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Room Type:</strong>
                        <select class="form-control" name="room_type" id="room_type">
                            @foreach($roomCategories as $roomCategory)
                                <option value="{{$roomCategory->id}}" @if ($room->room_type === $roomCategory->id) selected @endif>{{$roomCategory->name}}</option>
                            @endforeach
                        </select>
                        @error('room_type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Number of Beds:</strong>
                        <select class="form-control" name="number_of_beds" id="number_of_beds">
                            <?php $maxBeds = 11 ?>
                            @for ($i = 1; $i < $maxBeds; $i++)
                                <option value='{{$i}}' @if ($roomCategory->id === $i) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
                        @error('number_of_beds')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Create</button>
            </div>
        </form>
    </div>
    </body>
@endsection
