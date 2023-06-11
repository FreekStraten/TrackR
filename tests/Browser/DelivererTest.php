<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DelivererTest extends DuskTestCase
{
    // Create a test that switches the deliver of a packet.
    public function testDeliverer(): void
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
                ->pause(250)
                ->select('delivery_driver', 'DHL')
                ->assertSelected('delivery_driver', 'DHL');
        });
    }
}
