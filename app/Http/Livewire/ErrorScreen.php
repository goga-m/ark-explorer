<?php

namespace App\Http\Livewire;

use Livewire\Component;

/*
 * Abstract error screen
 */
class ErrorScreen extends Component
{
    /*
     * Error message
     *
     */
    public $errorMessage;

    /*
     * Error code.
     */
    public $errorCode;

    /**
     * Mount method
     *
     * @return void
     */
    public function mount($errorCode, $errorMessage)
    {

        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;

    }
    public function render()
    {
        return view('livewire.error-screen');
    }
}
