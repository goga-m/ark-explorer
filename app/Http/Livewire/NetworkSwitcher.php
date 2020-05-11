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
     * Get the existing selected network from session.
     * (SelectedNetwork Controller).
     */
    public function mount()
    {
        $this->selectedNetwork = SelectedNetwork::getName();
    }

    /*
     * Update selected network locally and in session.
     */
    public function changeNetwork($network)
    {

        SelectedNetwork::set($network);
        $this->selectedNetwork = $network;

        // Only to trigger the change happened, without values.
        // All components that are listening should be able to
        // retrieve network info from ChangeNetwork Controller (session).
        $this->emit('changeNetwork');
    }

    public function render()
    {
        return view('livewire.network-switcher');
    }
}
