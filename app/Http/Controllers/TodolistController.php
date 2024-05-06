<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;

    }

    public function getTodolist(Request $request): Response {

        $todolist = $this->todolistService->getTodolist();
        
        return response()->view('todolist.todolist', [
            'title' => 'Todolist',
            'todolist' => $todolist
        ]);
    }

    public function saveTodolist(Request $request): Response | RedirectResponse {
        
        $todolist = $this->todolistService->getTodolist();
        $dataTodo = $request->input('todo');

        if($dataTodo == "") {
            return response()->view('todolist.todolist', [
                'title' => 'Todolist',
                'todolist' => $todolist,
                'error' => 'Data Todo Tidak Boleh Kosong'
            ]);
        } else {
            $this->todolistService->saveTodo(uniqid(), $dataTodo);
            return redirect()->action([TodolistController::class, 'getTodolist']);
        }
    }

    public function deleteTodolist(Request $request, string $id): RedirectResponse {

        $this->todolistService->removeTodo($id);
        return redirect()->action([TodolistController::class, 'getTodolist']);
    }
}
