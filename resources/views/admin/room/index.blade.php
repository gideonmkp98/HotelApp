@extends('layouts.adminapp')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Room - List</h2>
                </div>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('rooms.create') }}"> Add Room</a>
                    </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{$message}}
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered" id="user-datatable">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Room Type</th>
                    <th>Number of Beds</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    </body>
    <script type="text/javascript">
        $.noConflict();
        jQuery( document ).ready(function( $ ) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#user-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/admin/rooms') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'room_type.name', name: 'room_type' },
                    { data: 'number_of_beds', name: 'number_of_beds' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'desc']]
            });
            $('body').on('click', '.delete', function () {
                if (confirm("Delete Record?") == true) {
                    var id = $(this).data('id');
// ajax
                    $.ajax({
                        type:"POST",
                        url: "{{ url('admin/delete-room') }}",
                        data: { id: id},
                        dataType: 'json',
                        success: function(res){
                            var oTable = $('#user-datatable').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            });
        });
    </script>
@endsection
