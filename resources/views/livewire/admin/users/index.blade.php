
<div>

    @include('livewire.admin.users.user-create-form')
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
                                <h3>Color
                                    <a href="" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createModal">Create</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-bordered table-sm table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                {{-- <td>{{$user->status == '1' ? 'hidden' : 'visible'}}</td> --}}
                                                <td>
                                                    @if($user->role_as == '0')
                                                        <label for="" class="badge btn-primary">User</label>
                                                    @elseif($user->role_as == '1')
                                                    <label for="" class="badge btn-success">Admin</label>
                                                    @else
                                                    <label for="" class="badge btn-danger">None</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" wire:click='editUser({{ $user->id }})' class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                                                    <a href="#"  wire:click='deleteUser({{ $user->id }})' class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Del</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No Record Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $users->links() }}
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
    