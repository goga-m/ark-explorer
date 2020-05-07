<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LayoutTest extends DuskTestCase
{
    /**
     * All sections should be present in the page.
     *
     * @return void
     */
    public function testLayoutShouldContainExpectedSections()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertPresent('main')
                    ->assertPresent('nav')
                    ->assertPresent('h1')
                    ->assertPresent('.main-content');
        });
    }
    /**
     * Navigation should containt (ordered) expected titles.
     *
     * @return void
     */
    public function testNavigationShouldContainExpectedTitles()
    {
        $this->browse(function (Browser $browser) {
            $this->assertEquals('Blocks', $browser->text('nav ul li:nth-of-type(1) a'));
            $this->assertEquals('Transactions', $browser->text('nav ul li:nth-of-type(2) a'));
            $this->assertEquals('Wallets', $browser->text('nav ul li:nth-of-type(3) a'));
        });
    }
    /**
     * Navigation should containt (ordered) expected links.
     *
     * @return void
     */
    public function testNavigationLinksShouldContainExpectedLinks()
    {
        $this->browse(function (Browser $browser) {
            $this->assertStringContainsString('/', $browser->attribute('nav ul li:nth-of-type(1) a', 'href'));
            $this->assertStringContainsString('/transactions', $browser->attribute('nav ul li:nth-of-type(2) a', 'href'));
            $this->assertStringContainsString('/wallets', $browser->attribute('nav ul li:nth-of-type(3) a', 'href'));
        });
    }
    /**
     * Navigation links should containt title attributes.
     *
     * @return void
     */
    public function testNavigationLinksShouldContainExpectedTitleAttributes()
    {
        $this->browse(function (Browser $browser) {
            $this->assertStringContainsString('View latest blocks', $browser->attribute('nav ul li:nth-of-type(1) a', 'title'));
            $this->assertStringContainsString('View latest transactions', $browser->attribute('nav ul li:nth-of-type(2) a', 'title'));
            $this->assertStringContainsString('View wallets', $browser->attribute('nav ul li:nth-of-type(3) a', 'title'));
        });
    }
}
