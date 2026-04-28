<?php

namespace Controllers;

use Core\Attributes\Route;
use Core\MVC\ControllerBase;
use Core\Request;
use Core\Response;
use Models\Aim;
use Repositories\AimRepository;

#[Route('aims')]
class AimController extends ControllerBase
{
    private AimRepository $repo;

    public function __construct()
    {
        $this->repo = new AimRepository();
    }

    public function index(Request $request): Response
    {
        $userId = $request->user->id ?? 0;
        $role = $request->user->role ?? 'user';

        $aims = $role === 'admin' ? $this->repo->findAll() : $this->repo->findByUserId($userId);

        return $this->view('aims/index', [
            'title' => 'Цілі',
            'aims' => $aims,
        ]);
    }

    #[Route('create', 'GET')]
    public function create(): Response
    {
        return $this->view('aims/create', [
            'title' => 'Нова ціль',
        ]);
    }

    #[Route('store', 'POST')]
    public function store(Request $request): Response
    {
        $this->repo->create(new Aim(
            user_id: (int) ($request->user->id ?? 1),
            name: $request->post('name'),
            target_amount: (float) $request->post('target_amount'),
            current_amount: (float) $request->post('current_amount', 0),
        ));

        return $this->redirect('/aims');
    }

    #[Route('edit/{id}', 'GET')]
    public function edit(int $id, Request $request): Response
    {
        $userId = $request->user->id ?? 0;
        $role = $request->user->role ?? 'user';

        $aim = $this->repo->findById($id);
        if (!$aim || ($role !== 'admin' && $aim->user_id !== $userId)) {
            return $this->redirect('/aims');
        }

        return $this->view('aims/edit', [
            'title' => 'Редагувати ціль',
            'aim' => $aim,
        ]);
    }

    #[Route('update/{id}', 'POST')]
    public function update(int $id, Request $request): Response
    {
        $userId = $request->user->id ?? 0;
        $role = $request->user->role ?? 'user';

        $existing = $this->repo->findById($id);
        if (!$existing || ($role !== 'admin' && $existing->user_id !== $userId)) {
            return $this->redirect('/aims');
        }
        $this->repo->update(new Aim(
            user_id: (int) ($request->user->id ?? 1),
            name: $request->post('name'),
            target_amount: (float) $request->post('target_amount'),
            current_amount: (float) $request->post('current_amount', 0),
            id: $id,
        ));

        return $this->redirect('/aims');
    }

    #[Route('delete/{id}', 'POST')]
    public function destroy(int $id, Request $request): Response
    {
        $userId = $request->user->id ?? 0;
        $role = $request->user->role ?? 'user';

        $existing = $this->repo->findById($id);
        if ($existing && ($role === 'admin' || $existing->user_id === $userId)) {
            $this->repo->delete($id);
        }

        return $this->redirect('/aims');
    }
}
