<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    public $stat = [];
    public $showEditModal = false;
    public $user;
    public $userIdToRemove = null;

    public function render()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.users.list-users', ['users' => $users]);
    }

    public function addNew()
    {
        $this->stat             = [];
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

        $validateData['password'] = bcrypt($validateData['password']);

        User::create($validateData);
        $this->dispatchBrowserEvent('hide-form', ['message'  => 'User Added Successfully ']);
        return redirect()->back();
    }

    public function edit(User $user)
    {
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
}