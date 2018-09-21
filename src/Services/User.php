<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Services;


use Glugox\ACL\Models\Role;
use Glugox\ACL\Repositories\RolesRepository;

/**
 * Description of Auth
 *
 * @author User
 */
class User extends Service {
    
    protected $rolesRepository;


    /**
     * 
     * @param RolesRepository $rolesrepository
     */
    public function __construct( RolesRepository $rolesrepository ) {
        $this->rolesRepository = $rolesrepository;
    }

        
    public function addACL( $acl ){

        if(isset($acl['roles']['role'])){
            foreach ($acl['roles']['role'] as $role){
                $this->rolesRepository->upsert(['name' => $role['name']], $role);
            }
        }
    }

    public function current(){
        return \Auth::user();
    }


    public function getByEmail( $email ){
        return \App\User::where('email', $email)->get();
    }


}