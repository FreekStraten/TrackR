<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NavTest extends DuskTestCase
{
    public function testLogin(): void
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
                ->assertPathIs('/packets')
                ->assertAuthenticated();
        });
    }

    public function testHomepageLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('@nav-homepage') // Click on the homepage link
                ->assertPathIs('/packets'); // Update with the expected path after clicking the link
        });
    }

    public function testCreatePackageLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('@nav-create-package') // Click on the create package link
                ->assertPathIs('/create-package'); // Update with the expected path after clicking the link
        });
    }

// Add similar test methods for other navigation links

    public function testPickupsListLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('@nav-pickups') // Click on the pickups list link
                ->assertPathIs('/pickups'); // Update with the expected path after clicking the link
        });
    }

    // Admin routes:
    public function testAdminLinks(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('@nav-profile')
                ->pause(100)
                ->click('@nav-logout')
                ->pause(500);
            $browser->visit('/')
                ->assertPathIs('/login');
        });

        $this->browse(function (Browser $browser) {
            // login as admin
            $browser->visit('/login')
                ->pause(500)
                ->type('email', 'admin@admin.nl')
                ->type('password', 'admin')
                ->click('@login')
                ->pause(500)
                ->assertAuthenticated();
            $browser->visit('/')
                ->click('@nav-admin-index') // Click on the list user link
                ->assertPathIs('/admin'); // Update with the expected path after clicking the link
        });
    }

    // Normal reciever user routes:
    public function testRecieverLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('@nav-profile')
                ->pause(100)
                ->click('@nav-logout')
                ->pause(500);
            $browser->visit('/')
                ->assertPathIs('/login');
        });
        $this->browse(function (Browser $browser) {
            // login as normal user
            $browser->visit('/login')
                ->pause(500)
                ->type('email', 'reciever@gmail.com')
                ->type('password', 'reciever')
                ->click('@login')
                ->pause(500)
                ->assertAuthenticated();
            $browser->visit('/')
                ->click('@nav-recievers-index') // Click on the list user link
                ->assertPathIs('/recievers'); // Update with the expected path after clicking the link
            $browser->visit('/')
                ->click('@nav-recievers-history') // Click on the list user link
                ->assertPathIs('/recievers/history'); // Update with the expected path after clicking the link
        });
    }


}

