<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Controllers\Currency;

class WalletListItem extends Component
{
    /**
     * Holds the raw data from API response
     */
    public $data = [];

    /**
     * Formatted data for rendering.
     */
    public $formatted = [
        'path' => '',
        'address' => '',
        'publicKey' => '',
        'balance' => ''
    ];


    /**
     * Format for rendering.
     * Reduce nesting into 1 level of hierarchy.
     *
     * TODO: Consider creating a Wallet interface,
     * for data format integrity and formatting.
     *
     * @return mixed
     */
    public function format($wallet)
    {

        // path bases
        // TODO: Retrieve paths from AppSettings interface.
        $walletBasePath = '/wallet/';

        $formatted = array_merge($this->formatted, [
            'path' => $walletBasePath.$wallet['address'],
            'address' => $wallet['address'],
            'publicKey' => isset($wallet['publicKey']) ? $wallet['publicKey'] : '',
            'balance' => Currency::format($wallet['balance'])
        ]);

        return $formatted;
    }

    /**
     * Mount Component.
     * Update data form caller
     *
     * @return void
     */
    public function mount($data)
    {
        $this->data = $data;
        $this->formatted = $this->format($data);
    }

    public function render()
    {
        return view('livewire.wallet-list-item');
    }

}
