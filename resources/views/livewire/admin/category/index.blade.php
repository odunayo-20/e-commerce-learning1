<div>


<!-- Modal -->
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog        ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  wire:submit.prevent='destroyCategory'>

                <div class="modal-body">
                    <h6>Are you sure you want to delete this data?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Yes. Delete</button>
            </div>
        </form>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-primary" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Category
                        <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-primary float-end">Create</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered table-sm table-responsive-sm">
                        <thead>
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->status == '0' ? 'visible' : 'hidden' }}</td>
                                    <td>
                                        <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="#" wire:click='deleteCategory({{ $category->id }})' data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-danger">Del</a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="4">No Record Found</td>
                            @endforelse
    
    
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>

    window.addEventListener('close-modal', event => {
        $('#deleteModal').modal('hide');
    });
    </script>
@endpush
