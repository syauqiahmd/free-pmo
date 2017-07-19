<?php

use App\Entities\Users\User;

class ResetPasswordTest extends TestCase
{
    /** @test */
    public function user_can_reset_password_by_their_email()
    {
        // $user = factory(User::class)->create();
        $user1 = factory(User::class)->create(['username' => '123456', 'email' => 'testing@app.dev']);

        // Reset Request
        $this->visit('password/reset');
        $this->notSeeInDatabase('password_resets', [
            'email' => 'testing@app.dev'
        ]);
        $this->see(trans('auth.reset_password'));
        $this->type('testing@app.dev','email');
        $this->press(trans('auth.send_reset_password_link'));
        $this->seePageIs('password/reset');
        $this->see(trans('passwords.sent'));
        $this->seeInDatabase('password_resets', [
            'email' => 'testing@app.dev'
        ]);

    }

}
