<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class UserMessageController extends Controller
{
    private $messageRepository;
    private $userRepository;

    public function __construct(
        MessageRepositoryInterface $messageRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
    }

    public function index($userId)
    {
        $options = [
            'filter' => ['user_id' => $userId],
            'limit' => config('common.message.user_message_limit'),
        ];
        $messages = $this->messageRepository->all($options);

        $user = $this->userRepository->show($userId);

        if (isset($user['error'])) {
            return response()->json(['error' => ($user['error'])]);
        }

        $data = [
            'messages' => $messages,
            'user' => $user,
        ];

        return response()->json($data);
    }
}
