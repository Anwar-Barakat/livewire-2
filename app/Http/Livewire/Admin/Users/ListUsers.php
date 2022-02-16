<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class ListUsers extends AdminComponent
{
    use WithFileUploads;

    public $stat = [];
    public $showEditModal   = false;
    public $user;
    public $userIdToRemove  = null;
    public $searchTerm      = null;
    protected $queryString  = ['searchTerm' => ['except' => '']];
    public $image;
    public $sortColumn      = 'created_at';
    public $sortDirection   = 'DESC';

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumn, $this->sortDirection)->paginate(10);
        return view('livewire.admin.users.list-users', ['users' => $users]);
    }

    public function addNew()
    {
        $this->reset();
        $this->showEditModal    = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser()
    {
        $validateData = Validator::make($this->stat, [
            'name'          => 'required',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:6|confirmed'
        ])->validate();

        $validateData['password']   = bcrypt($validateData['password']);

        if ($this->image) {
            $validateData['image']  = $this->image->store('/', 'avatars');
        }

        User::create($validateData);
        $this->dispatchBrowserEvent('hide-form', ['message'  => 'User Added Successfully ']);
        return redirect()->back();
    }

    public function edit(User $user)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->stat = $user->toArray();
        $this->dispatchBrowserEvent('show-form');

        // for update
        $this->user = $user;
    }

    public function updateUser()
    {
        $validateData = Validator::make($this->stat, [
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,' . $this->user->id,
            'password'      => 'sometimes|confirmed'
        ])->validate();

        if (!empty($validateData['password'])) {
            $validateData['password'] = bcrypt($validateData['password']);
        }

        if ($this->image) {
            Storage::disk('avatars')->delete($this->user->image);
            $validateData['image']  = $this->image->store('/', 'avatars');
        }

        $this->user->update($validateData);
        $this->dispatchBrowserEvent('hide-form', ['message'  => 'User Updated Successfully ']);
        return redirect()->back();
    }

    public function confirmUserDelete($id)
    {
        $this->userIdToRemove = $id;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::where('id', $this->userIdToRemove)->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message'  => 'User deleted Successfully ']);
    }

    public function updateRole(User $user, $role)
    {
        Validator::make(['role' => $role], [
            'role'  => [
                'required',
                Rule::in(User::ROLE_ADMIN, User::ROLE_USER)
            ]
        ])->validate();
        $user->update(['role'   => $role]);
        $this->dispatchBrowserEvent('updated', ['message'  => "Role Changed to ({$role}) Successfully"]);
    }

    public function sortBy($sort)
    {
        if ($this->sortColumn == $sort)
            $this->sortDirection    = $this->swapSortDirection();
        else
            $this->sortDirection    = 'ASC';

        $this->sortColumn       = $sort;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}