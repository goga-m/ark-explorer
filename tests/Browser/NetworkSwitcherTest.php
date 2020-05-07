<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NetworkSwitcherTest extends DuskTestCase
{
    /**
     * User should interact with network selector dropdown.
     * Opening dropdown, and closing when clicking away.
     *
     * @return void
     */
    public function testUserShouldInteractWithNetworkSwitcherDropdown()
    {
        $this->browse(function (Browser $browser) {
          $browser->visit('/');

          // On dropdown open
          $browser->click('.network-switcher button');
          $browser->assertVisible('.network-switcher-menu');

          // On click away
          $browser->click('main');
          $browser->assertMissing('.network-switcher-menu');

        });
    }
    /**
     * User should change selected network.
     *
     * When uses switches the selected network/chain,
     * SelectedNetwork Controller is called to update
     * session value 'selectedNetwork'.
     *
     * This lifecycle results in updating the dropdown selection.
     *
     * This test will update both values Mainnet, Devnet and see them displayed,
     * in the selected dropdown area.
     *
     * @return void
     */
    public function testShouldChangeSelectedNetwork()
    {
        $this->browse(function (Browser $browser) {

          $browser->with('.network-switcher', function ($dropdown) {

              // Click first option.
              $dropdown->click('button');
              $clickedNetwork = $dropdown->text('ul li:nth-of-type(1) a');
              $dropdown->click('ul li:nth-of-type(1) a');
              $dropdown->pause(1000);
              $dropdown->assertSeeIn('.selected-network', $clickedNetwork);

              // Click second option.
              $dropdown->click('button');
              $clickedOtherNetwork = $dropdown->text('ul li:nth-of-type(2) a');
              $dropdown->click('ul li:nth-of-type(2) a');
              $dropdown->pause(1000);
              $dropdown->assertSeeIn('.selected-network', $clickedOtherNetwork);

          });
        });
    }
}
