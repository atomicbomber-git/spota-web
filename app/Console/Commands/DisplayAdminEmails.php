<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DisplayAdminEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show all admin emails';

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
     * @return mixed
     */
    public function handle()
    {
        $this->line(
            \App\Lecturer::all()->count()
        );
        return;

        \App\Admin::query()
            ->with(['user' => function ($query) {
                $query->where('users.type', 'A');
            }])
            ->get()
            ->each(function ($admin) {
                $this->line($admin->user->email);
            });
    }
}
