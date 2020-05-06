<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;

class NavigationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShouldShowAllNavigationMenuItems()
    {
        $menu = Livewire::test('menu');
        $menu->assertSee('Transactions');
        $menu->assertSee('Blocks');
        $menu->assertSee('Wallets');
    }
}
