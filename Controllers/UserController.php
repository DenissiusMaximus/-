<?php

namespace Controllers;

use Core\Attributes\Route;
use Core\MVC\ControllerBase;
use Core\Request;
use Core\Response;
use Models\User;
use Repositories\UserRepository;

#[Route('users')]
class UserController extends ControllerBase
{
    private UserRepository $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    public function index(Request $request): Response
    {
        $userId = $request->user->id ?? 0;
        $role = $request->user->role ?? 'user';

        $users = $role === 'admin' ? $this->repo->findAll() : [$this->repo->findById($userId)];

        return $this->view('users/index', [
            'title' => 'Користувачі',
            'users' => $users,
        ]);
    }

    #[Route('create', 'GET')]
    public function create(Request $request): Response
    {
        if ($request->user->role !== 'admin') {
            return $this->redirect('/users');
        }

        return $this->view('users/create', [
            'title' => 'Новий користувач',
        ]);
    }

    #[Route('store', 'POST')]
    public function store(Request $request): Response
    {
        if ($request->user->role !== 'admin') {
            return $this->redirect('/users');
        }

        $this->repo->create(new User(
            name: $request->post('name'),
            email: $request->post('email'),
            password_hash: password_hash($request->post('password'), PASSWORD_BCRYPT),
            role: $request->post('role', 'user'),
        ));

        return $this->redirect('/users');
    }

    #[Route('edit/{id}', 'GET')]
    public function edit(int $id, Request $request): Response
    {
        if ($request->user->role !== 'admin' && $request->user->id !== $id) {
            return $this->redirect('/users');
        }

        return $this->view('users/edit', [
            'title' => 'Редагувати користувача',
            'user' => $this->repo->findById($id),
        ]);
    }

    #[Route('update/{id}', 'POST')]
    public function update(int $id, Request $request): Response
    {
        if ($request->user->role !== 'admin' && $request->user->id !== $id) {
            return $this->redirect('/users');
        }

        $existing = $this->repo->findById($id);
        $password = $request->post('password');
        $hash = $password ? password_hash($password, PASSWORD_BCRYPT) : $existing->password_hash;

        $this->repo->update(new User(
            name: $request->post('name'),
            email: $request->post('email'),
            password_hash: $hash,
            role: $request->post('role', 'user'),
            id: $id,
        ));

        return $this->redirect('/users');
    }

    #[Route('delete/{id}', 'POST')]
    public function destroy(int $id, Request $request): Response
    {
        if ($request->user->role !== 'admin' && $request->user->id !== $id) {
            return $this->redirect('/users');
        }

        $this->repo->delete($id);

        return $this->redirect('/users');
    }
}
