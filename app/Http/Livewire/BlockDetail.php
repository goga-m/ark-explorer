<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SelectedNetwork;
use App\Http\Controllers\Currency;
use Jenssegers\Date\Date;

class BlockDetail extends Component
{

    /**
     * Block id to show details for.
     */
    public $blockId;

    /**
     * Error code, in case of a request error,
     */
    public $errorCode;

    /**
     * Error message, in case of a request error,
     */
    public $errorMessage;

    /**
     * Block data.
     */
    public $block = [
        'id' => '',
        'path' => '',
        'height' => '',
        'timestamp' => '',
        'transactions' => '',
        'confirmations' => '',
        'generatorPath' => '',
        'generatorAddress' => '',
        'generatorUsername' => '',
        'reward' => '',
        'forgedTotal' => '',
        'processedAmount' => '',
        'fees' => ''
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
     * Fetch block from blockchain.
     *
     * @return void
     */
    public function fetchBlock()
    {
        $this->status = 'Loading';
        $apiUrl = SelectedNetwork::getUrl().'/blocks/'.$this->blockId;

        $response = Http::get($apiUrl);

        if($response->successful()) {

            $this->errorCode = null;
            $this->errorMessage = null;
            $this->status = 'Success';

            $responseData = $response->json();
            $this->block = $this->formatBlockItem($responseData['data']);

        } else {

            $error = $response->json();
            $this->errorMessage = $error['message'];
            $this->errorCode = $error['statusCode'];
            $this->status = 'Failure';

            $this->block = [];
        }
    }

    /**
     * Retrieve the block id parameter from caller.
     *
     * @return void
     */
    public function mount($blockId)
    {
        $this->blockId = $blockId;
    }

    /**
     * Format block for rendering.
     * Reduce nesting into 1 level of hierarchy.
     *
     * TODO: Consider creating a Block interface,
     * for data format integrity and formatting.
     *
     * @return void
     */
    public function formatBlockItem($block)
    {

        // path bases
        // TODO: Retrieve paths from AppSettings interface.
        $blockBasePath = '/block/';
        $walletBasePath = '/wallet/';

        $formatted = array_merge($this->block, [
            'id' => $block['id'],
            'path' => $blockBasePath.$block['id'],
            'height' => number_format($block['height']),
            'timestamp' => Date::parse($block['timestamp']['human']),
            'transactions' => $block['transactions'],
            'confirmations' => $block['confirmations'],
            'generatorPath' => $walletBasePath.$block['generator']['address'],
            'generatorAddress' => $block['generator']['address'],
            'generatorUsername' => $block['generator']['username'],
            'reward' => Currency::format($block['forged']['reward']),
            'forgedTotal' => Currency::format($block['forged']['total']),
            'processedAmount' => Currency::format($block['forged']['amount']),
            'fees' => Currency::format($block['forged']['fee'])
        ]);

        return $formatted;
    }

    public function render()
    {
        return view('livewire.block-detail');
    }
}
