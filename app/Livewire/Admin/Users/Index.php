<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $name, $email, $role_as, $password, $user;


public function storeUser(){
    $this->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|min:8|max:10',
        'role_as' => 'required|string',
    ]);

    User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password),
        'role_as' => $this->role_as,
    ]);

    session()->flash('success', ' Successfully Created');
    $this->reset();
    $this->dispatch('close-modal');
}
    
public function editUser(User $user){
$this->user = $user;
$this->name = $user->name;
$this->email = $user->email;
$this->role_as = $user->role_as;
// $this->password =  $user->password;
}



public function updateUser(){
    $this->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'password' => 'nullable|min:8|max:10',
        'role_as' => 'required|string',
    ]);
    
    $this->user->update([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password),
        'role_as' => $this->role_as,
    ]);
    session()->flash('success', 'Successfully Updated');
    $this->reset();
    $this->dispatch('close-modal');
    
}

public function deleteUser($userId){
    $this->user = $userId;
}

public function destroyUser(){
    User::findOrFail($this->user)->delete();
    session()->flash('success', 'Successfully Deleted');
    $this->dispatch('close-modal');
}


    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.users.index', compact('users'))
        ->extends('layouts.admin')->section('content');
    }
}