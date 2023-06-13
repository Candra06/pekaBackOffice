<?php

namespace App\Console\Commands;

use App\Models\NoteUser;
use Carbon\Carbon;
use Helper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReminderCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $note = NoteUser::join('users', 'users.id', 'note_user.user_id')
            ->select('users.remember_token', 'note_user.*')
            ->get();
        foreach ($note as $value) {
            $now = explode("T", Carbon::now());
            $tmp = explode(" ", $now[0]);
            // return  $tmp[0];
            if ($value['remember_token'] != '-' && $value['date'] == $tmp[0]) {
                Helper::sendNotif($value['remember_token'], 'Reminder', $value['note']);
                Log::info("Jalan yak!");
                // return $value;
            }
        }
        return 1;
    }
}
