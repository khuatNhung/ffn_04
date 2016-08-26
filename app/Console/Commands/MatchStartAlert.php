<?php
namespace App\Console\Commands;

use App\Repositories\Message\MessageRepositoryInterface;
use Illuminate\Console\Command;

class MatchStartAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:match_start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $messageRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->description = trans('message.alert_user_about_match_start');
        $this->messageRepository = $messageRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->messageRepository->alertMatchStart();
    }
}
