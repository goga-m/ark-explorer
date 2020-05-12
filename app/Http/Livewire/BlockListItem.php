<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Controllers\Currency;
use Jenssegers\Date\Date;

class BlockListItem extends Component
{
    /**
     * Holds the raw block data from API response
     */
    public $data = [];

    /**
     * Formatted block data
     */
    public $block = [
        'id' => '',
        'path' => '',
        'height' => '',
        'timestamp' => '',
        'transactions' => '',
        'generatorPath' => '',
        'generatorAddress' => '',
        'generatorUsername' => '',
        'forgedTotal' => '',
        'fee' => ''
    ];


    /**
     * Mount BlockListItem Component.
     * Update data form caller
     *
     * @return void
     */
    public function mount($data)
    {
        $this->data = $data;
        $this->block = $this->formatBlockItem($data);
    }

    /**
     * Format block for rendering.
     * Reduce nesting into 1 level of hierarchy.
     *
     * TODO: Consider creating a Block interface,
     * for data format integrity and formatting.
     *
     * @return mixed
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
            'generatorPath' => $walletBasePath.$block['generator']['address'],
            'generatorAddress' => $block['generator']['address'],
            'generatorUsername' => $block['generator']['username'],
            'forgedTotal' => Currency::format($block['forged']['total']),
            'fee' => Currency::format($block['forged']['fee'])
        ]);

        return $formatted;
    }


    public function render()
    {
        return view('livewire.block-list-item');
    }
}
