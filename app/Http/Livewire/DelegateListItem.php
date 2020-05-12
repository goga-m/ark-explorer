<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Controllers\Currency;

use Jenssegers\Date\Date;

class DelegateListItem extends Component
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
        'username' => '',
        'address' => '',
        'rank' => '',
        'votes' => '',
        'status' => '',
        'lastForged' => '',
        'forgedAt' => ''
    ];


    /**
     * Format for rendering.
     * Reduce nesting into 1 level of hierarchy.
     *
     * TODO: Consider creating a Wallet interface,
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
            'username' => $wallet['username'],
            'rank' => $wallet['rank'],
            'status' => isset($wallet['isResigned']) && $wallet['isResigned'] ? 'Resigned' : 'Active',
            'votes' => Currency::format($wallet['votes'])
        ]);

        if(isset($wallet['blocks'])) {

            if(isset($wallet['blocks']['produced'])) {
                $formatted['forgedBlocks'] = number_format($wallet['blocks']['produced']);
            }

            if(isset($wallet['blocks']['last'])) {
                $lastBlock = $wallet['blocks']['last'];
                $date = Date::parse($lastBlock['timestamp']['human']);
                $formatted['lastForged']  = $date->ago();
            }
        }

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
        return view('livewire.delegate-list-item');
    }
}
