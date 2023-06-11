<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PickupTest extends DuskTestCase
{
    // Create a test for planning a pickup.
    public function testPickupPlanning(): void
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
                    ->click('.cursor-pointer') // Click on the first packet to select it
                    ->assertVisible('.pickup-button') // Ensure the create pickup button is visible
                    ->click('.pickup-button') // Click the create pickup button
                    ->pause(500)
                    ->assertPathIs('/pickups/create') // Assert that the user is redirected to the create pickup page
                    ->assertQueryStringHas('pickupsids') // Ensure the query string contains the selected packet IDs
                    ->assertSee(__('pickups.plan_pickup')) // Assert that the create pickup page is displayed
                    ->assertSee(__('pickups.pickups')) // Assert that the header is displayed
                    ->assertSee(__('pickups.plan_pickup')) // Assert that the subheader is displayed
                    ->assertVisible('#date') // Assert that the date field is visible
                    ->assertVisible('#time') // Assert that the time field is visible
                    ->assertVisible('input[name="pickup_street"]') // Assert that the pickup street field is visible
                    ->assertVisible('input[name="pickup_house_number"]') // Assert that the pickup house number field is visible
                    ->assertVisible('input[name="pickup_city"]') // Assert that the pickup city field is visible
                    ->assertVisible('input[name="pickup_zip_code"]') // Assert that the pickup zip code field is visible
                    ->assertVisible('button[type="submit"]') // Assert that the submit button is visible
                    ->assertVisible('table') // Assert that the table is visible
                    ->assertSee(__('messages.date')) // Assert that the date column is displayed in the table
                    ->assertSee(__('messages.tracking_number')); // Assert that the tracking number column is displayed in the table
            });
    }

}
