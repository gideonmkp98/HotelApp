<a href="{{ route('reservations.show',$id) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-secondary edit">
    View
</a>
<a href="{{ route('reservations.edit',$id) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success edit">
    Edit
</a>
<a href="javascript:void(0)" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">
    Delete
</a>
