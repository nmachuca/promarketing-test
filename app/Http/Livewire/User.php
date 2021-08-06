<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User as UserModel;

class User extends Component
{
    public $users, $name, $role, $email, $user_id, $roles, $password;
    public $isModalCreateUpdateOpen = 0;

    public function render()
    {
        $this->roles = Role::all();
        $this->users = UserModel::all();
        return view('livewire.user');
    }

    public function create()
    {

        $this->resetCreateForm();
        $this->openModalCreateUpdate();
    }

    public function openModalCreateUpdate()
    {
        $this->isModalCreateUpdateOpen = true;
    }

    public function closeModalCreateUpdate()
    {
        $this->isModalCreateUpdateOpen = false;
    }

    private function resetCreateForm(){
        $this->name = '';
        $this->email = '';
        $this->role = '';
    }

    public function find($id) {
        $user = UserModel::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function store($action)
    {
        if($action == "edit") {
            $this->validate([
                'name' => 'required|string|min:3|max:50',
                'email' => 'required|string|email|min:13|max:255',
                'role' => 'required|string',
            ]);
        } else {
            $this->validate([
                'name' => 'required|string|min:3|max:50',
                'email' => 'required|string|email|min:13|max:255',
                'role' => 'required|string',
                'password' => 'required|string|min:8'
            ]);
        }

        $user = UserModel::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $user->removeRole('viewer');
        $user->removeRole('writer');
        $user->removeRole('admin');
        $user->assignRole($this->role);

        session()->flash('message', $this->user_id ? 'User updated.' : 'User created.');

        $this->closeModalCreateUpdate();
        $this->resetCreateForm();

    }

    public function edit($id)
    {
        $this->find($id);
        $this->openModalCreateUpdate();
    }

    public function delete($id)
    {
        UserModel::find($id)->delete();
        session()->flash('message', 'Game deleted.');
    }
}
