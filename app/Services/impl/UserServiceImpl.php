<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService {

   public array $users = [
      "Zuleriqhbal" => "rahasia"
   ];

   public function login(string $user, string $password): bool {

      if(!isset($this->users[$user])) {
         return false;
      }

      $passwordUser = $this->users[$user];
      return $password == $passwordUser;
   }

}