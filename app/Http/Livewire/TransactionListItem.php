<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\Currency;

use Jenssegers\Date\Date;

class TransactionListItem extends Component
{
    /**
     * Holds the raw transaction data from API response
     */
    public $data = [];

    /**
     * tx format
     */
    public $tx = [
        'id' => '',
        'path' => '',
        'blockId' => '',
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
    ];

    /**
     * Format transaction for rendering.
     * Reduce nesting into 1 level of hierarchy.
     *
     * TODO: Consider creating a Transaction interface,
     * for data format integrity and formatting.
     *
     * @return mixed
     */
    public function format($tx)
    {
        // path bases
        // TODO: Retrieve paths from AppSettings interface.
        $txBasePath = '/transaction/';
        $walletBasePath = '/wallet/';

        $formatted = array_merge($this->tx, [
            'id' => $tx['id'],
            'path' => $txBasePath.$tx['id'],
            'blockId' => $tx['blockId'],
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

        return $formatted;
    }

    public function mount($data)
    {
        $this->data = $data;
        $this->tx = $this->format($data);
    }

    public function render()
    {
        return view('livewire.transaction-list-item');
    }
}
