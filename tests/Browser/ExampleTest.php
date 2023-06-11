<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->pause(500)
                ->type('email', 'normal@user.com')
                ->pause(500)
                ->type('password', 'user')
                ->pause(500)
                ->click('@login')
                ->pause(750)
                ->visit('/')
                ->pause(750)
                ->assertPathIs('/');
        });
    }


    public function testFormSubmission()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('create-package'))
                ->pause(500) // Add a pause to ensure the page is fully loaded
                ->click('@tab1') // Make sure the desired tab is active
                ->type('date', '2023-05-28')
                ->select('format', 'letter')
                ->type('weight', '1')
                ->type('shipping_streetname', '123 Shipping St')
                ->type('input[name="shipping_housenumber"]', '10')
                ->type('input[name="shipping_city"]', 'Shipping City')
                ->type('input[name="shipping_zipcode"]', '12345')
                ->type('input[name="delivery_streetname"]', '456 Delivery St')
                ->type('input[name="delivery_housenumber"]', '20')
                ->type('input[name="delivery_city"]', 'Delivery City')
                ->type('input[name="delivery_zipcode"]', '54321')
                ->press('Submit')
                ->assertPathIs('/create-package');
        });
    }

    public function testPacketsTableIsVisible()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('user-packets-list'))
                ->assertVisible('#packets-table');
        });
    }
}
