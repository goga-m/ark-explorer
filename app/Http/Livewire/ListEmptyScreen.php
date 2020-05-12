<?php

namespace App\Http\Livewire;

use Livewire\Component;

/*
 * Empty screen for lists.
 */
class ListEmptyScreen extends Component
{
    /*
     * Empty list title.
     *
     */
    public $title = 'Unfortunately';

    /*
     * Empty list description.
     */
    public $description = 'No results were found.';

    /**
     * Mount method
     *
     * @return void
     */
    public function mount($title, $description)
    {

        $this->title = $title;
        $this->description = $description;

    }

    public function render()
    {
        return view('livewire.list-empty-screen');
    }
}
