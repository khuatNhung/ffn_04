<?php
namespace App\Events;

use Illuminate\Queue\SerializesModels;

class UserCreated extends Event
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
