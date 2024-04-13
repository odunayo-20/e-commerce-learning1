
<div>

    @include('livewire.admin.slider.create-form')
            <!-- Modal -->
          
                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-primary" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3>Slider
                                    <a href="" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createModal">Create</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-bordered table-sm table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sliders as $slider)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$slider->title}}</td>
                                                <td>{{$slider->description}}</td>
                                                <td><img src="{{ Storage::url($slider->image) }}" alt=""></td>
                                                <td>{{$slider->status == '1' ? 'hidden' : 'visible'}}</td>
                                                <td>
                                                    <a href="#" wire:click='editSlider({{ $slider->id }})' class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                                                    <a href="#"  wire:click='deleteSlider({{ $slider->id }})' class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Del</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No Record Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $sliders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @push('script')
            <script>
            
                window.addEventListener('close-modal', event => {
                    $('#createModal').modal('hide');
                    $('#editModal').modal('hide');
                    $('#deleteModal').modal('hide');
                });
                </script>
            @endpush
            
    </div>
    