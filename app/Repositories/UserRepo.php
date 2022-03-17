<?php

namespace App\Repositories;

use App\Models\User;
use SocialiteProviders\Manager\OAuth2\User as UserOAuth;


class UserRepo
{

    public function getUserBySocId(UserOAuth $user, string $socName) {
        
        $userInDb = User::query()
            ->where('id_in_soc', $user->id)
            ->where('type_auth', $socName)
            ->firstOrCreate([
                'name' => !empty($user->getName()) ? $user->getName() : '',
                'email' => !empty($user->getEmail()) ? $user->getEmail() : '',
                'password' => '',
                'id_in_soc' => !empty($user->getId()) ? $user->getId() : '',
                'type_auth' => $socName,
                'avatar' => !empty($user->getAvatar()) ? $user->getAvatar() : '',
            ]);

            return $userInDb;
    }

}
