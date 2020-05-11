<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Controllers\Currency;
use App\Http\Controllers\SelectedNetwork;
use Illuminate\Support\Facades\Http;

class NetworkInfo extends Component
{
    /**
     * Network info data
     */
    public $data = [
        'height' => '',
        'network' => '',
        'supply' => '',
    ];

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
     * Listen to network change event.
     *
     * 'changeNetwork' when user changes network.
     */
    protected $listeners = [
        'changeNetwork' => 'onNetworkChange'
    ];

    /**
     * Event handler for network change.
     *
     * @return void
     */
    public function onNetworkChange()
    {
        $this->fetchInfo();
    }

    /**
     * Fetch info
     *
     * @return void
     */
    public function fetchInfo($silent = false)
    {
        // No loading screens on silend mode.
        if(!$silent) {
            $this->status = 'Loading';
        }

        $this->fetch();
    }

    /**
     * Format data before rendering
     *
     * @param array raw network data
     * @return array
     */
    public function format($info)
    {

        $formatted = array_merge($this->data, [
            'height' => number_format($info['block']['height']),
            'supply' => Currency::format($info['supply']),
            'network' => SelectedNetwork::getName()
        ]);

        return $formatted;
    }

    /**
     * Fetch network information.
     *
     * Update request status & errors accordinly.
     *
     * @return void
     */
    private function fetch()
    {
        $apiUrl = SelectedNetwork::getUrl().'/blockchain';
        $response = Http::get($apiUrl);

        if($response->successful()) {

            $this->status = 'Success';
            $responseData = $response->json();
            $this->data = $this->format($responseData['data']);


        } else {

            $this->status = 'Failure';
        }

    }

    public function mount() {

        $this->fetchInfo();
    }

    public function render()
    {
        return view('livewire.network-info');
    }
}
