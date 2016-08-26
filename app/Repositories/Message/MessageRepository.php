<?php
namespace App\Repositories\Message;

use App\Models\Match;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Models\Message;
use App\Repositories\Match\MatchRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Auth;
use DB;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    protected $matchRepository;
    protected $userRepository;

    public function __construct(
        Message $message,
        MatchRepositoryInterface $matchRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->model = $message;
        $this->matchRepository = $matchRepository;
        $this->userRepository = $userRepository;
    }

    public function all($options = [])
    {
        try {
            $filter = isset($options['filter']) ? $options['filter'] : [];
            $limit = isset($options['limit']) ? $options['limit'] : config('common.limit.page_limit');
            $data = $this->model->where($filter)->orderBy('id', 'DESC')->take($limit)->get();

            if (!count($data)) {
                return ['error' => trans('message.item_not_exist')];
            }

            return $data;
        } catch (Exception $ex) {
            return ['error' => $ex->getMessage()];
        }
    }

    public function alertMatchStart()
    {
        try {
            $matches = $this->matchRepository->getRecentMatches();

            if (count($matches)) {
                $type = config('common.message.type.match_start');
                $checkDuplicatedMessage = $this->checkDuplicatedMessage($matches[0], $type);

                if (!$checkDuplicatedMessage) {
                    $messages = [];
                    $users = $this->userRepository->whereRole(config('common.user.role.user'));

                    if (count($users)) {
                        // create new message
                        foreach ($matches as $match) {
                            $content = $this->getMessageContent($type, $match);
                            foreach ($users as $user) {
                                $messages[] = [
                                    'user_id' => $user->id,
                                    'type' => $type,
                                    'content' => $content,
                                    'target' => $match->id,
                                ];
                            }
                        }

                        $data = $this->model->insert($messages);

                        // update unread message number for all users
                        $additionalUnreadMessage = count($matches);
                        $this->userRepository->increaseMessage($users, $additionalUnreadMessage);

                        return $data;
                    }
                }
            }
        } catch (Exception $ex) {
            return ['error' => $ex->getMessage()];
        }
    }

    public function checkDuplicatedMessage($data, $type)
    {
        $returnedData = $this->model->where(['type' => $type, 'target' => $data['id']])->get();

        if (count($returnedData)) {
            return true;
        }

        return false;
    }

    public function store($input)
    {
        try {
            $data = $this->model->create($input);

            if (!$data) {
                return ['error' => trans('message.creating_error')];
            }

            $additionalUnreadAdminMessage = 1;
            User::find($input['user_id'])->increment('unread_message_number', $additionalUnreadAdminMessage);

            return $data;
        } catch (Exception $ex) {
            return ['error' => $ex->getMessage()];
        }
    }

    public function createMessageToNewUser($user)
    {
        $data = [
            'user_id' => $user['id'],
            'content' => trans('message.hello_user'),
            'type' => config('common.message.type.user_event'),
            'target' => $user['id'],
        ];

        $this->store($data);
    }
}
