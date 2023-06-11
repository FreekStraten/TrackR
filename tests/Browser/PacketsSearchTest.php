<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PacketsSearchTest extends DuskTestCase
{
    // Create a test for searching in the list of packets
    public function testPacketSearch(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->pause(500)
                ->type('email', 'normal@user.com')
                ->pause(500)
                ->type('password', 'user')
                ->pause(500)
                ->click('@login')
                ->pause(500)
                ->visit('/packets')
                ->pause(500)
                ->assertPathIs('/packets')
                ->type('search', 'example search term')
                ->pause(500)
                ->keys('input[name="search"]', '{enter}')
                ->pause(1000)
                ->assertQueryStringHas('search', 'example search term');
        });
    }

}
