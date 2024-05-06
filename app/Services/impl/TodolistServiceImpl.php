<?php


namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService {

   public function getTodolist(): array
   {
      return Session::get('todolist', []);
   }

   public function saveTodo(string $id, string $todo): void
   {
      if (!Session::exists('todolist')) {
         Session::put('todolist', []);
      }

      Session::push("todolist", [
         "id" => $id,
         "todo" => $todo
      ]);
   }

   public function removeTodo(string $id)
   {
      $getTodolist = Session::get("todolist");

      foreach ($getTodolist as $index => $value) {
         if ($value['id'] == $id) {
            unset($getTodolist[$index]);
            break;
         }
      }

      Session::put('todolist', $getTodolist);
   }

}