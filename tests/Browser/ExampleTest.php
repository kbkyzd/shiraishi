<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }

    public function testCreds()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('login')
                    ->type('email', 'test@test.test')
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records');
        });
    }
}
