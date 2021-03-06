<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Users') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('Users') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between mb-2">
                            <x-search-input wire:model="searchTerm" />
                            <button class="btn btn-info" wire:click.prevent="addNew">
                                <i class="fas fa-plus"></i> Create New User
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col ">
                                                <div class="d-flex justify-content-between">
                                                    <span>Name</span>
                                                    <span wire:click="sortBy('name')" class="sm"
                                                        style="cursor: pointer">
                                                        <i
                                                            class="fa fa-arrow-up fa-sm {{ $sortColumn == 'name' && $sortDirection == 'asc' ? '' : 'text-muted' }}"></i>
                                                        <i
                                                            class="fa fa-arrow-down fa-sm {{ $sortColumn == 'name' && $sortDirection == 'desc' ? '' : 'text-muted' }}"></i>
                                                    </span>
                                                </div>
                                            </th>
                                            <th scope="col">Image</th>
                                            <th scope="col">
                                                <div class="d-flex justify-content-between">
                                                    <span>Email</span>
                                                    <span wire:click="sortBy('email')" class="sm"
                                                        style="cursor: pointer">
                                                        <i
                                                            class="fa fa-arrow-up fa-sm {{ $sortColumn == 'email' && $sortDirection == 'asc' ? '' : 'text-muted' }}"></i>
                                                        <i
                                                            class="fa fa-arrow-down fa-sm {{ $sortColumn == 'email' && $sortDirection == 'desc' ? '' : 'text-muted' }}"></i>
                                                    </span>
                                                </div>
                                            </th>
                                            <th scope="col">Registered</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Optioins</th>
                                        </tr>
                                    </thead>
                                    <tbody wire:loading.class="text-muted">
                                        @forelse ($users as $index => $user)
                                            <tr>
                                                <td>{{ $users->firstItem() + $index }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    <img src="{{ $user->image_url }}" alt="" width="50px"
                                                        class="img-circle img-thumbnail" style="height: 50px">
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at?->toFormattedDate() }}</td>
                                                <td>
                                                    <select class="form-control"
                                                        wire:change="updateRole({{ $user }},$event.target.value)">
                                                        <option value="admin"
                                                            {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                                        </option>
                                                        <option value="user"
                                                            {{ $user->role == 'user' ? 'selected' : '' }}>User
                                                        </option>
                                                    </select>
                                                </td>
                                                <td class="">
                                                    <div class="w-50 d-flex justify-content-around">
                                                        <a href="" class="text-info"
                                                            wire:click.prevent="edit({{ $user }})">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="" class="text-danger"
                                                            wire:click.prevent="confirmUserDelete({{ $user }})">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="5">
                                                    <img src="{{ asset('AdminLTE/dist/img/search.png') }}"
                                                        width="300" alt="">
                                                    <p class="mt-3">No Users Found !!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="mt-3 d-flex justify-content-end">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-header -->

    <!-- Add New User Modal -->
    <div class="modal fade" id="FormAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if (!$showEditModal)
                                <span>Add New User</span>
                            @else
                                <span>Edit User</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="img m-auto d-block" width="150" alt="">
                            <hr>
                        @else
                            <img src="{{ $stat['image_url'] ?? '' }}" class="img m-auto d-block" width="150" alt="">
                        @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" wire:model.defer="stat.name"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter Full Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" wire:model.defer="stat.email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Enter The Email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" wire:model.defer="stat.password"
                                class="form-control  @error('password') is-invalid @enderror" id="password"
                                placeholder="Enter The Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" wire:model.defer="stat.password_confirmation"
                                class="form-control  @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" placeholder="Enter Confirm Password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="customFile">Profile Image</label>
                            <div class="custom-file">
                                <div x-data="{ isUploading:false,progress:0 }"
                                    x-on:livewire-upload-start="isUploading=true"
                                    x-on:livewire-upload-finish="isUploading=false,progress=0"
                                    x-on:livewire-upload-error="isUploading=false"
                                    x-on:livewire-upload-progress="progress=$event.detail.progress">
                                    <input wire:model="image" type="file" class="custom-file-input" id="customFile">
                                    <div x-show="isUploading" class="progress progress-sm mt-3">
                                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                            x-bind:style="`width:${progress}%`">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                                <label class="custom-file-label" for="customFile">
                                    @if ($image)
                                        {{ $image->getClientOriginalName() }}
                                    @else
                                        Choose Image
                                    @endif
                                </label>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>
                            @if ($showEditModal)
                                <span>Update</span>
                            @else
                                <span>Save</span>
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete User</h5>
                </div>
                <div class="modal-body">
                    <h5>Are You Sure The Deletion Process ??</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i
                            class="fas fa-trash-alt mr-1"></i>
                        <span>Delete</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
