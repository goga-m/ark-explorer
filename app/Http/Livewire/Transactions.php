<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SelectedNetwork;

class Transactions extends Component
{
    /**
     * Transactions list
     * based on pagination & limit.
     */
    public $txs = [];

    /**
     * Maximum pages. Given by API response.
     */
    public $pageCount = 1;

    /**
     * Error code, in case of a request error,
     */
    public $errorCode;

    /**
     * Error message, in case of a request error,
     */
    public $errorMessage;

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
     * Number to limit result (on request)
     */
    public $limit = 15;

    /**
     * Page
     */
    public $page = 1;

    /**
     * Listen to events.
     *
     * 'page' event from pagination,
     * 'changeNetwork' when user changes network.
     */
    protected $listeners = [
        'page' => 'onPageChange',
        'changeNetwork' => 'onNetworkChange'
    ];

    /**
     * Chain API url to fetch data from.
     *
     * @return string
     */
    public function getApiUrl($queryParams) {

        $apiUrl = SelectedNetwork::getUrl().'/transactions?'.http_build_query($queryParams);
        return $apiUrl;
    }

    /**
     * Fetch transactions.
     *
     * Update request status & errors accordinly.
     *
     * @return void
     */
    private function fetch($page, $limit)
    {
        $queryParams = [
            'page' => $page,
            'limit'=> $limit
        ];

        $apiUrl = $this->getApiUrl($queryParams);
        $response = Http::get($apiUrl);

        if($response->successful()) {

            $this->errorCode = null;
            $this->errorMessage = null;
            $this->status = 'Success';
            $responseData = $response->json();

            $this->txs = $responseData['data'];
            $this->pageCount = $responseData['meta']['pageCount'];

        } else {

            $error = $response->json();
            $this->errorMessage = $error['message'];
            $this->errorCode = $error['statusCode'];
            $this->status = 'Failure';

            $this->txs = [];
        }

    }

    /**
     * Fetch txs,
     * emit event for pager.
     *
     * @return void
     */
    public function fetchTxs($page, $silent = false)
    {
        // No loading screens on silend mode.
        if(!$silent) {
            $this->status = 'Loading';
        }

        $this->page = $page;
        $this->fetch($this->page, $this->limit);

        // Emit events
        $this->emit('refreshPager', $this->pageCount, $this->limit, $this->page);
    }

    /**
     * Fetch silently without setting state to 'Loading'.
     * Used for polling
     *
     * emit event for pager.
     *
     * @return void
     */
    public function fetchSilent()
    {
        $this->fetch($this->page, $this->limit);
        // Emit events to page to get the new data.
        $this->emit('refreshPager', $this->pageCount, $this->limit, $this->page);
    }

    /**
     *
     * Event handler for network change.
     * Refetch transactions on network change, reset page (to 1).
     *
     * @return void
     */
    public function onNetworkChange()
    {
        return redirect()->to('/transactions/1');
    }

    /**
     * Event handler for page event (from pager)
     *
     * @return void
     */
    public function onPageChange($page)
    {
        return redirect()->to('/transactions/'.$page);
    }

    /**
     * Update page count if provided.
     *
     * @return void
     */
    public function mount($page = 1, $walletAddress = null, $transactionType = 'all')
    {
        if($page) {
            $this->page = $page;
        }

        // Emit events to page to get the new data.
        $this->emit('refreshPager', $this->pageCount, $this->limit, $this->page);
    }

    public function render()
    {
        return view('livewire.transactions');
    }
}
