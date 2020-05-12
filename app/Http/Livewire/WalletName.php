<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SelectedNetwork;

/*
 * Given a publicKey,
 * lazy-fetch wallet's username.
 */
class WalletName extends Component
{
    /**
     * Wallet publicKey
     */
    public $publicKey;

    /**
     * Wallet Address
     */
    public $walletAddress;

    /**
     * Wallet id to filter transactions.
     */
    public $username;

    /**
     * Possible states.
     *
     * Loading  - We've asked, and we are waiting for response.
     * Failure  - We asked, and error occured. Show error.
     * Success  - Succesfull fetch, data is available.
     *
     * Set initial state to Loading.
     *
     */
    public $status = 'Loading';

    /**
     * Fetch wallet from blockchain.
     *
     * @return void
     */
    public function fetchWallet()
    {
        $this->status = 'Loading';

        $apiUrl = SelectedNetwork::getUrl().'/wallets/'.$this->publicKey;
        $response = Http::get($apiUrl);

        if($response->successful()) {
            $this->status = 'Success';

            $responseData = $response->json();
            $walletData = $responseData['data'];

            if(isset($walletData['username'])) {
                $this->username = $walletData['username'];
            } else {
                // Fallback if username does not exist
                $this->username = $this->publicKey;
            }


        } else {
            // Use publickey as a fallback display name.
            $this->username = $this->publicKey;
            $this->status = 'Failure';
        }
    }

    /**
     * Get the publickey from parent
     *
     * @return void
     */
    public function mount($publicKey)
    {
        $this->publicKey = $publicKey;
    }

    public function render()
    {
        return view('livewire.wallet-name');
    }
}
