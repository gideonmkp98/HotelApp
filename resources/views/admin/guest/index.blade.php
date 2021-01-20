@extends('layouts.adminapp')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Guest - List</h2>
                </div>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('guests.create') }}"> Add Guest</a>
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
                    <th>User</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>Actions</th>

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
                ajax: "{{ url('/admin/guests') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'user.email', name: 'user mail', defaultContent: "Not Set" },
                    { data: 'firstname', name: 'firstname' },
                    { data: 'lastname', name: 'lastname' },
                    { data: 'phone', name: 'phone' },
                    { data: 'country', name: 'country' },
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
                        url: "{{ url('admin/delete-guest') }}",
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
