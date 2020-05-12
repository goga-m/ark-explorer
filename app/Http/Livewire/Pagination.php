<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Pagination extends Component
{
    /**
     * Maximum pages
     */
    public int $pageCount = 0;

    /**
     * Limit lists items.
     */
    public int $limit = 0;

    /**
     * Active page.
     */
    public $page;

    /**
     * Page number input field value.
     */
    public $inputPage;

    /**
     * Optional context label.
     *
     * Showing x to x of x $contextLabel
     */
    public $contextLabel;

    /**
     * Listen to parent events (refresh with new data).
     */
    protected $listeners = ['refreshPager' => 'updateData'];

    /**
     * Parameters here are passed by the parent component.
     * @return void
     */
    public function updateData($pageCount, $limit, $page)
    {
        $this->pageCount = $pageCount;
        $this->limit = $limit;
        $this->page = $page;
        $this->inputPage = $page;
    }

    /**
     * Page change handler.
     * Emits change page event to listeners.
     *
     * @return void
     */
    public function page($page)
    {
        $this->emitUp('page', $page);
    }

    /**
     * Parameters here are passed by the parent component.
     *
     * @return void
     */
    public function mount($pageCount, $limit, $page)
    {
        $this->updateData($pageCount, $limit, $page);
    }


    public function render()
    {
        return view('livewire.pagination');
    }

    /**
     * Validate & correct page input number.
     *
     * Hook called on input field change.
     *
     * @return void
     */
    public function updatedInputPage($value)
    {
        // Validate and correct input if necessary.

        // Bottom limit = 1
        if(!$value || $value < 1) {
            $this->inputPage = 1;
        }

        // Top limit = $pageCount
        if($value > $this->pageCount) {
            $this->inputPage = $this->pageCount;
        }

    }



}
