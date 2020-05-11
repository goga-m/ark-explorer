<?php

namespace App\Http\Livewire;

use Livewire\Component;

/*
 * Table skeleton screen.
 *
 * To be rendered when loading a table.
 */
class TableSkeleton extends Component
{
    /*
     * Columns names that will be rendered
     *
     * Format: [
     *  'label' => 'classname'
     * ]
     *
     * Array of th names.
     */
    public $columnLabels = [];

    /*
     * List count.
     */
    public $limit = 1;

    /**
     * Mount method
     *
     * @return void
     */
    public function mount($limit, $columnLabels)
    {

        $this->limit = $limit;
        $this->columnLabels = $columnLabels;

    }

    public function render()
    {
        return view('livewire.table-skeleton');
    }
}