<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.navbar');
    }

    public function toHome()

    {



        return redirect()->to('/');
    }



    public function toEvent()

    {

        // Redirect ke halaman tentang kami

        return redirect()->to('/event');
    }



    public function toAboutUs()

    {

        // Redirect ke halaman kontak

        return redirect()->to('/about-us');
    }
}
