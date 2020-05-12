<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navigation extends Component
{

    /**
     * Main navigation items are defined here.
     */
    public $navigationItems = [
        ['name' => 'Blocks', 'title'=> 'View latest blocks', 'path'=> '/'],
        ['name' => 'Transactions', 'title'=> 'View latest transactions', 'path'=> '/transactions'],
        ['name' => 'Wallets', 'title'=> 'View wallets', 'path'=> '/wallets'],
    ];

    public function render()
    {
        return view('livewire.navigation');
    }
}
