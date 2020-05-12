<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SelectedNetwork;
use App\Http\Controllers\Currency;
use Jenssegers\Date\Date;

class TransactionDetail extends Component
{
    /**
     * Transaction id to show details for.
     */
    public $txId;

    /**
     * Error code, in case of a request error,
     */
    public $errorCode;

    /**
     * Error message, in case of a request error,
     */
    public $errorMessage;

    /**
     * tx format
     */
    public $tx = [
        'id' => '',
        'path' => '',
        'blockId' => '',
        'blockPath' => '',
        'timestamp' => '',
        'senderAddress' => '',
        'senderPath' => '',
        'recipientAddress' => '',
        'recipientPath' => '',
        'vendorField' => '',
        'amount' => '',
        'fee' => '',
        'transactionType' => '',
        'confirmations' => '',
        'nonce' => '',
        'payments' => []
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
     * Fetch transaction from blockchain.
     *
     * @return void
     */
    public function fetchTx()
    {
        $this->status = 'Loading';
        $apiUrl = SelectedNetwork::getUrl().'/transactions/'.$this->txId;

        $response = Http::get($apiUrl);

        if($response->successful()) {

            $this->errorCode = null;
            $this->errorMessage = null;
            $this->status = 'Success';

            $responseData = $response->json();
            $this->tx = $this->format($responseData['data']);

        } else {

            $error = $response->json();
            $this->errorMessage = $error['message'];
            $this->errorCode = $error['statusCode'];
            $this->status = 'Failure';

            $this->tx = [];
        }
    }

    /**
     * Format tx for rendering.
     * Reduce nesting into 1 level of hierarchy.
     *
     * TODO: Consider creating a Transaction interface,
     * for data format integrity and formatting.
     *
     * @return void
     */
    public function format($tx)
    {

        // path bases
        // TODO: Retrieve paths from AppSettings interface.
        $txBasePath = '/transaction/';
        $blockBasePath = '/block/';
        $walletBasePath = '/wallet/';

        $formatted = array_merge($this->tx, [
            'id' => $tx['id'],
            'path' => $txBasePath.$tx['id'],
            'blockId' => $tx['blockId'],
            'blockPath' => $blockBasePath.$tx['blockId'],
            'timestamp' => Date::parse($tx['timestamp']['human']),
            'senderAddress' => $tx['sender'],
            'senderPath' => $walletBasePath.$tx['sender'],
            'recipientAddress' => $tx['recipient'],
            'recipientPath' => $walletBasePath.$tx['recipient'],
            'vendorField' => isset($tx['vendorField']) ? $tx['vendorField'] : '' ,
            'amount' => Currency::format($tx['amount']),
            'fee' => Currency::format($tx['fee']),
            'transactionType' => $tx['type'],
            'confirmations' => $tx['confirmations'],
            'nonce' => $tx['nonce'],
            'fee' => Currency::format($tx['fee'])
        ]);

        if(isset($tx['asset']) && isset($tx['asset']['payments'])) {
            $formatted['payments'] = $tx['asset']['payments'];
        }

        return $formatted;
    }

    /**
     * Retrieve the transaction id parameter from caller.
     *
     * @return void
     */
    public function mount($txId)
    {
        $this->txId = $txId;
    }

    public function render()
    {
        return view('livewire.transaction-detail');
    }
}
