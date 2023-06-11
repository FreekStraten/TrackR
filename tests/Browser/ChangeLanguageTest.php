<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ChangeLanguageTest extends DuskTestCase
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
                ->assertPathIs('/packets');
        });
    }

    public function testSwitchLangToDutch(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertAuthenticated()
                ->click('@open-nav-lang') // Click on the dropdown trigger button (update the selector if needed
                ->pause(500)
                ->click('@lang-dutch') // Click on the English language button (update the selector if needed)
                ->pause(500)
                ->assertSee('Taal');
        });

    }

    public function testSwitchLangToEnglish(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertAuthenticated()
                ->click('@open-nav-lang') // Click on the dropdown trigger button (update the selector if needed
                ->pause(500)
                ->click('@lang-english') // Click on the English language button (update the selector if needed)
                ->pause(500)
                ->assertSee('Language');
        });
    }

}
