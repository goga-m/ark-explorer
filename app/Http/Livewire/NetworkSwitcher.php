<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\SelectedNetwork;

class NetworkSwitcher extends Component
{
    /*
     * Holds the selected network for apis to operate
     */
    public $selectedNetwork;

    protected $_selectedNetworkHandler;

    /*
     * Available networks to provide to the dropdown.
     */
    public $availableNetworks = [
        ['value'=> 'Mainnet', 'title' => 'Switch to Mainnet'],
        ['value'=> 'Devnet', 'title' => 'Switch to Devnet']
    ];

    /*
     * Get the existing selected network from session
     * (SelectedNetwork Controller).
     */
    public function mount()
    {
        $networkHandler = new SelectedNetwork();
        $this->selectedNetwork = $networkHandler->getName();
    }

    /*
     * Update selected network locally and in session.
     */
    public function changeNetwork($network)
    {

        $networkHandler = new SelectedNetwork();
        $networkHandler->set($network);

        $this->selectedNetwork = $network;
    }

    public function render()
    {
        return view('livewire.network-switcher');
    }
}
