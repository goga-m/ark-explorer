<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Transactions;
use App\Http\Controllers\SelectedNetwork;

/**
 * Listing of wallet transactions.
 * Extends Transactions listing component.
 */
class WalletTransactions extends Transactions
{

    /**
     * Wallet id to render transactions for.
     */
    public $walletAddress;

    /**
     * The type of the transaction
     *
     * all  - all transactions.
     * sent - transactions that the wallet received.
     * received  - transactions that the wallet sent.
     *
     * Defaults to all
     *
     */
    public $transactionType = 'all';

    /**
     * Listen to events.
     *
     * 'page' event from pagination,
     * 'changeNetwork' when user changes network.
     */
    protected $listeners = [
        'page' => 'onPageChange'
    ];

    /**
     * Chain API url to fetch data from.
     * Override default (See App\Http\Livewire\Transactions;)
     *
     * @hook
     * @return string
     */
    public function getApiUrl($queryParams) {

        $txTypePath = $this->transactionType === 'all' ? '' : '/'.$this->transactionType;
        $apiBase = SelectedNetwork::getUrl();
        $apiUrl = $apiBase.'/wallets/'.$this->walletAddress.'/transactions'.$txTypePath.'?'.http_build_query($queryParams);
        return $apiUrl;
    }

    /**
     * Event handler for page event (from pager)
     *
     * @return void
     */
    public function onPageChange($page)
    {
        $newPagePath = '/wallet/'.$this->walletAddress.'/transactions/'.$this->transactionType.'/'.$page;
        return redirect()->to($newPagePath);
    }

    /**
     * Override default (Transaction's) override method to include
     * transactionType and walletAddress
     *
     * @return void
     */
    public function mount($page = 1, $walletAddress = null, $transactionType = 'all')
    {
        if(isset($page)) {
            $this->page = $page;
        }

        if(isset($transactionType)) {
            $this->transactionType = $transactionType;
        }

        if(isset($walletAddress)) {
            $this->walletAddress = $walletAddress;
        }

        // Emit events to page to get the new data.
        $this->emit('refreshPager', $this->pageCount, $this->limit, $this->page);
    }

    public function render()
    {
        return view('livewire.wallet-transactions');
    }
}
