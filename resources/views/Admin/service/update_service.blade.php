<a type="button"   class="text-white btn btn-success btn-sm font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $data->id }}">

    Edit
    <i class="bi bi-pencil"></i>

</a>

<div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
    aria-labelledby="exampleModal{{ $data->id }}Label{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal{{ $data->id }}Label{{ $data->id }}">
                    Service
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/update_service/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">

                            Title
                        </label>
                        <input type="text" name="title" class="form-control" required value="{{ $data->title }}">
                    </div>



                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">

                            Description
                        </label>
                        <textarea type="text" name="description" class="form-control" required>{{ $data->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">
                            Image
                        </label>
                    <div>
                        <img src="/service/{{ $data->icon }}" width="100px" />
                    </div>

                        <input type="file" name="icon" class="form-control mt-3"  >
                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Update
                        <i class="bi bi-pencil"></i>
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
