<?php
namespace App\Listeners;

use App\Events\UserCreated;
use App\Repositories\Message\MessageRepositoryInterface;

class UserCreatedListener
{
    private $messageRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        MessageRepositoryInterface $messageRepository
    ) {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Handle the event.
     *
     * @param  CreateBet  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        $this->messageRepository->createMessageToNewUser($user);
    }
}
