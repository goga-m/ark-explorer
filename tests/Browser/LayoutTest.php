<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LayoutTest extends DuskTestCase
{
    /**
     * All sections are present in the page.
     *
     * @return void
     */
    public function testLayoutStructureSectionsArePresent()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertPresent('main')
                    ->assertPresent('nav')
                    ->assertPresent('h1')
                    ->assertPresent('.main-content');
        });
    }
}
