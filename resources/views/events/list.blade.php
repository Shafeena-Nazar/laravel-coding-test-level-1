@include('common.header')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Events</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('newEvent') }}">Add New</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created Date</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->slug }}</td>
                                <td>{{ date('Y-m-d',strtotime($event->createdAt)) }}</td>
                                <td>
                                    <button class="btn btn-danger deleteEvent" data-id="{{ $event->id }}">Delete
                                    </button>
                                    <a href="{{ route('editEvent',$event->id) }}" class="btn btn-success">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $events->links() }}
            </div>
        </div>
    </div>
</div>
@include('common.footer')
<script>
    var ajax_url = '/srujan/admin/';
    $(document).on("click", ".deleteProduct", function () {
        if (confirm("Do you want to delete this entry??")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                'url': ajax_url + 'delete-product',
                'method': 'post',
                'data': {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': $(this).attr('data-id'),
                },
                'dataType': 'json',
                success: function (data) {
                    if (data['status'] == 1) {
                        alert("Deleted!", "Your product has been deleted");
                    } else {
                        alert("Unable to delete product");
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                    // window.location.reload();

                }
            });
        }
    });

    $(document).on("click", ".deleteEvent", function () {
        if (confirm("Do you want to delete??")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                'url': '{{ route('deleteEvent') }}',
                'method': 'post',
                'data': {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': $(this).attr('data-id'),
                },
                'dataType': 'json',
                success: function (data) {
                    if (data['status'] == 1) {
                        alert("Deleted!", "Record removed");
                    } else {
                        alert("Unable to delete event");
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            });
        }
    });

</script>
