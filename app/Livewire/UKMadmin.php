<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UKM;
use Livewire\WithFileUploads;

class UKMadmin extends Component
{
    use WithFileUploads;

    public $name, $username, $email, $password, $profile_picture, $description, $twitter, $facebook, $youtube, $instagram, $ukm;
    public $statusCode = 2;
    public function render()
    {
        $this->ukm = UKM::latest()->get();
        return view('livewire.UKMadmin');
    }

    // ...
    public function store()
    {

        // dd([
        //     'name' => $this->name,
        //     'username' => $this->username,
        //     'email' => $this->email,
        //     'password' => $this->password,
        //     'profile_picture' => $this->profile_picture,
        //     'description' => $this->description,
        //     'twitter' => $this->twitter,
        //     'facebook' => $this->facebook,
        //     'youtube' => $this->youtube,
        //     'instagram' => $this->instagram,
        // ]);

        // $this->validate([
        //     'name' => 'required|string|max:255',
        //     'username' => 'required|string|max:255|unique:UKM',
        //     'email' => 'required|email|unique:UKM',
        //     'password' => 'required|min:6',
        //     'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'description' => 'nullable|string',
        //     'twitter' => 'nullable|string',
        //     'facebook' => 'nullable|string',
        //     'youtube' => 'nullable|string',
        //     'instagram' => 'nullable|string',
        // ]);

        // Manipulasi gambar jika diupload
        $imageName = time() . '.' . $this->profile_picture->extension();
        $this->profile_picture->storeAs('images', $imageName);

        UKM::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'profile_picture' => $imageName,
            'description' => $this->description,
            'twitter' => $this->twitter,
            'facebook' => $this->facebook,
            'youtube' => $this->youtube,
            'instagram' => $this->instagram,
        ]);

        session()->flash('message', 'Data UKM berhasil ditambahkan!');
        $this->reset(); // Reset input fields setelah data berhasil ditambahkan
        return view('livewire.UKMadmin');
    }


    public function changeTab($status)
    {
        $this->statusCode = $status;
    }


}
