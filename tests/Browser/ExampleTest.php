<?php

namespace Tests\Browser;

use Carbon\Carbon;
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
                ->type('password', 'user')
                ->click('@login')
                ->pause(500)
                ->visit('/')
                ->pause(500)
                ->assertPathIs('/packets');
        });
    }


    public function testFormSubmission()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('create-package'))
                ->pause(500) // Add a pause to ensure the page is fully loaded
                ->click('@tab1') // Make sure the desired tab is active
                ->type('date', '01-01-2023')
                ->select('format', 'letter')
                ->type('weight', '1')
                ->type('shipping_streetname', '123 Shipping St')
                ->type('shipping_housenumber', '10')
                ->type('shipping_city', 'Shipping City')
                ->type('shipping_zipcode', '12345')
                ->type('delivery_streetname', '456 Delivery St')
                ->type('delivery_housenumber', '20')
                ->type('delivery_city', 'Delivery City')
                ->type('delivery_zipcode', '54321')
                ->press(__('messages.create_packet_button'))
                ->assertPathIs('/package')
                ->pause(1000);
        });
    }


    public function testCsvUpload()
    {
        $csvFilePath = public_path('test.csv');

        if (!file_exists($csvFilePath)) {
            throw new \RuntimeException("CSV file not found: {$csvFilePath}");
        }

        $this->browse(function (Browser $browser) use ($csvFilePath) {
            $browser->visit(route('create-package'))
                ->pause(500) // Add a pause to ensure the page is fully loaded
                ->click('@tab2') // Make sure the desired tab is active
                ->attach('csv_file', $csvFilePath)
                ->press(__('messages.upload'));

            $displayProperty = $browser->driver->executeScript(
                "return window.getComputedStyle(document.querySelector('[dusk=\"tab2\"]')).display;"
            );

            $this->assertNotEquals('none', $displayProperty);
        });
    }

    public function testQrCode()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('user-packets-list'))
                ->waitFor('.fa-qrcode') // Wait for the QR code icon to be visible
                ->click('.fa-qrcode') // Click on the QR code icon
                ->assertPathIsNot(route('user-packets-list')); // Assert that the URL has changed
        });
    }


    public function testSortingOptions()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('packets.index'))
                ->assertSee(__('messages.my_packets'));

            $browser->select('format', 'letter')
                ->pause(500) // Add a delay to allow the page to update
                ->assertPathIs('/packets')
                ->assertQueryStringHas('format', 'letter')
                ->assertSee(__('messages.letter'));

            $browser->select('format', 'parcel')
                ->pause(500) // Add a delay to allow the page to update
                ->assertPathIs('/packets')
                ->assertQueryStringHas('format', 'parcel')
                ->assertSee(__('messages.parcel'));

            $browser->select('sortByDate', 'asc')
                ->pause(500) // Add a delay to allow the page to update
                ->assertPathIs('/packets')
                ->assertQueryStringHas('format', 'parcel') // Update the expected value to 'parcel'
                ->assertQueryStringHas('sortByDate', 'asc')
                ->assertSee(__('messages.date_asc'));

            $browser->select('sortByDate', 'desc')
                ->pause(500) // Add a delay to allow the page to update
                ->assertPathIs('/packets')
                ->assertQueryStringHas('format', 'parcel') // Update the expected value to 'parcel'
                ->assertQueryStringHas('sortByDate', 'desc')
                ->assertSee(__('messages.date_desc'));

            $browser->select('sortDirection', 'asc')
                ->pause(500) // Add a delay to allow the page to update
                ->assertPathIs('/packets')
                ->assertQueryStringHas('format', 'parcel') // Update the expected value to 'parcel'
                ->assertQueryStringHas('sortDirection', 'asc')
                ->assertSee(__('messages.weight_asc'));

            $browser->select('sortDirection', 'desc')
                ->pause(500) // Add a delay to allow the page to update
                ->assertPathIs('/packets')
                ->assertQueryStringHas('format', 'parcel') // Update the expected value to 'parcel'
                ->assertQueryStringHas('sortDirection', 'desc')
                ->assertSee(__('messages.weight_desc'));
        });
    }
}



