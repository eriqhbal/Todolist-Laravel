<?php

namespace App\Services;

interface TodolistService {

   public function getTodolist(): array;

   public function saveTodo(string $id, string $todo):void;

   public function removeTodo(string $id);
}