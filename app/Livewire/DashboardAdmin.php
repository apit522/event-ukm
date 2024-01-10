<?php

namespace App\Livewire;

use App\Models\Invoice;
use Livewire\Component;

class DashboardAdmin extends Component
{


    public function render()
    {

        return view('livewire.dashboard-admin');
    }
    public function pindahHalaman($halaman)
    {
        return view("admin.$halaman");
    }



}
