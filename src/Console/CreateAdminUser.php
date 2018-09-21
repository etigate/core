<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Console;

use App\User;
use Glugox\Core\Contracts\IModule;



/**
 * Description of InstallModule
 *
 * @author Ervin
 */
class CreateAdminUser extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:create-admin-user {email?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creats a new admin user.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        $email = $this->argument('email') ?? \config('core.user.admin.defaults.email');
        $password = $this->argument('password') ?? \config('core.user.admin.defaults.password');

        $this->info('Creating admin user '.$email.'...');

        return User::updateOrCreate(['email' => $email], [
            'name'      => \config('core.user.admin.defaults.name'),
            'email'     => $email,
            'password'  => \Hash::make($password)
        ]);
        //$adminUser->roles()->attach(\config('user.admin_role_id')); // admin


    }



    

}
