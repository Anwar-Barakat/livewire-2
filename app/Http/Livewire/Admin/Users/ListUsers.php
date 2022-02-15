<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
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
    public $image;

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
            ->orderBy('id', 'desc')->paginate(10);
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
}