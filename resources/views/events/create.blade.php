@include('common.header')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            @if(isset($id))
            <h4 class="mb-sm-0 font-size-18">Edit</h4>
            @else
                <h4 class="mb-sm-0 font-size-18">Create New</h4>
            @endif
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Events</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('events') }}">Show List</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="post"
                      @if(isset($id))  action="{{ route('updateEvent') }}" @else action="{{ route('newEvent') }}" @endif>
                    @csrf
                    <div class="row mb-4">
                        <label for="name" class="col-form-label col-lg-2">Event Name</label>
                        <div class="col-lg-10">
                            <input id="eventName"
                                   @if(isset($id)) value="{{ $event['id'] }}" @else value="" @endif
                                   name="id" type="hidden" class="form-control" >

                            <input id="eventName" required  @if(isset($id)) value="{{ $event['name'] }}" @else value="{{ old('name') }}" @endif
                            name="name" type="text" class="form-control" placeholder="Enter event name...">
                            @error('name')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="slug" class="col-form-label col-lg-2">Event Slug</label>
                        <div class="col-lg-10">
                            <input id="eventSlug"  required  @if(isset($id)) value="{{ $event['slug'] }}" @else value="{{ old('slug') }}" @endif name="slug" type="text" class="form-control" placeholder="Enter event slug...">
                            @error('slug')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary" name="btnAdd" value="save">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('common.footer')
