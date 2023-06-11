<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CalendarTest extends DuskTestCase
{
    // Create a test for the calendar page
    public function testCalendar(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'normal@user.com')
                ->type('password', 'user')
                ->click('@login')
                ->assertAuthenticated();

            $browser->visit('/calendar')
                ->assertPathIs('/calendar')
                ->assertSee(__('calendar.calendar_overview'))
                ->assertSee(__('calendar.previous_month'))
                ->assertSee(__('calendar.next_month'));

            // Click on previous month link
            $browser->clickLink(__('calendar.previous_month'))
                ->pause(500)
                ->assertPathBeginsWith('/calendar')
                ->assertQueryStringHas('year')
                ->assertQueryStringHas('month');

            // Click on next month link
            $browser->clickLink(__('calendar.next_month'))
                ->pause(500)
                ->assertPathBeginsWith('/calendar')
                ->assertQueryStringHas('year')
                ->assertQueryStringHas('month');

            // Go back to the calendar view
            $browser->visit('/calendar')
                ->assertPathIs('/calendar');
        });
    }

}
