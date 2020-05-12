<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SelectedNetwork;
use App\Http\Controllers\Currency;

class WalletDetail extends Component
{
    /**
     * Wallet address to show details for.
     */
    public $walletAddress;

    /**
     * Pager count for transactions list.
     */
    public $page;

    /**
     * The type of the transactions to render.
     *
     * all  - all transactions.
     * sent - transactions that the wallet received.
     * received  - transactions that the wallet sent.
     *
     * Defaults to all
     *
     */
    public $transactionType;

    /**
     * Error code, in case of a request error,
     */
    public $errorCode;

    /**
     * Error message, in case of a request error,
     */
    public $errorMessage;

    /**
     * Formatted data for rendering.
     */
    public $formatted = [
        'username' => null,
        'path' => '',
        'address' => '',
        'publicKey' => '',
        'balance' => '',
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
     * Fetch wallet from blockchain.
     *
     * @return void
     */
    public function fetchWallet()
    {
        $this->status = 'Loading';
        $apiUrl = SelectedNetwork::getUrl().'/wallets/'.$this->walletAddress;

        $response = Http::get($apiUrl);

        if($response->successful()) {

            $this->errorCode = null;
            $this->errorMessage = null;
            $this->status = 'Success';

            $responseData = $response->json();
            $this->formatted = $this->format($responseData['data']);

        } else {

            $error = $response->json();
            $this->errorMessage = $error['message'];
            $this->errorCode = $error['statusCode'];
            $this->status = 'Failure';

            $this->formatted = [];
        }
    }

    /**
     * Format wallet for rendering.
     * Reduce nesting into 1 level of hierarchy.
     *
     * TODO: Consider creating a Transaction interface,
     * for data format integrity and formatting.
     *
     * @return void
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

        // Extra fields for delegates
        if(isset($wallet['attributes']) && isset($wallet['attributes']['delegate'])) {
            $formatted['username'] = $wallet['attributes']['delegate']['username'];
            $formatted['voteBalance'] = Currency::format(($wallet['attributes']['delegate']['voteBalance']));
            $formatted['forgedRewards'] = Currency::format(($wallet['attributes']['delegate']['forgedRewards']));
            $formatted['forgedFees'] = Currency::format(($wallet['attributes']['delegate']['forgedFees']));
            $formatted['producedBlocks'] = number_format($wallet['attributes']['delegate']['producedBlocks']);
            $formatted['status'] = $wallet['isResigned'] ? 'Resigned' : 'Active';

            if(!$wallet['isResigned']) {
                $formatted['rank'] = $wallet['attributes']['delegate']['rank'];
            }
        }

        if(isset($wallet['vote'])) {
            $formatted['vote'] = $wallet['vote'];
        }

        return $formatted;
    }

    /**
     * Retrieve the wallet id parameter from caller.
     *
     * @return void
     */
    public function mount($page, $walletAddress = null, $transactionType = 'all')
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

    }

    public function render()
    {
        return view('livewire.wallet-detail');
    }

}
