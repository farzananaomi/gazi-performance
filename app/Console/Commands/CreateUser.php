<?php

namespace GaziWorks\Performance\Console\Commands;

use GaziWorks\Performance\Data\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create {--u|username=} {--p|password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an Authorized User';

    /**
     * Create a new command instance.
     *
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

        $username = $this->option('username');
        $password = $this->option('password');

        $user = new User();
        $user->username = $username;
        $user->password = bcrypt($password);
        $user->remember_token = bcrypt(time());
        $user->save();

        $this->info("User Created : {$user->username}");
    }
}
