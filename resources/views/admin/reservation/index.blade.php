@extends('layouts.adminapp')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Reservations</h2>
                </div>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('reservations.create') }}"> New Reservation</a>
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
                    <th>Guest</th>
                    <th>Room</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Accepted</th>
                    <th>Guests</th>
                    <th>Acions</th>
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
                ajax: "{{ url('/admin/reservations') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'guest.firstname', name: 'guest id', defaultContent: "Not Set" },
                    { data: 'room_id', name: 'room id' },
                    { data: 'check_in_date', name: 'check in' },
                    { data: 'check_out_date', name: 'check out' },
                    { data: 'accepted', name: 'accepted' },
                    { data: 'number_of_guests', name: 'guests' },
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
                        url: "{{ url('admin/delete-reservation') }}",
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
