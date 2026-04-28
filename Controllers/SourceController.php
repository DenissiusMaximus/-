<?php

namespace Controllers;

use Core\Attributes\Route;
use Core\MVC\ControllerBase;
use Core\Request;
use Core\Response;
use Models\Source;
use Repositories\SourceRepository;

#[Route('sources')]
class SourceController extends ControllerBase
{
    private SourceRepository $repo;

    public function __construct()
    {
        $this->repo = new SourceRepository();
    }

    public function index(Request $request): Response
    {
        $userId = $request->user->id ?? 0;
        $role = $request->user->role ?? 'user';

        $sources = $role === 'admin' ? $this->repo->findAll() : $this->repo->findByUserId($userId);

        return $this->view('sources/index', [
            'title' => 'Джерела коштів',
            'sources' => $sources,
        ]);
    }

    #[Route('create', 'GET')]
    public function create(): Response
    {
        return $this->view('sources/create', [
            'title' => 'Нове джерело',
        ]);
    }

    #[Route('store', 'POST')]
    public function store(Request $request): Response
    {
        $this->repo->create(new Source(
            user_id: (int) ($request->user->id ?? 1),
            name: $request->post('name'),
            balance: (float) $request->post('balance', 0),
        ));

        return $this->redirect('/sources');
    }

    #[Route('edit/{id}', 'GET')]
    public function edit(int $id, Request $request): Response
    {
        $userId = $request->user->id ?? 0;
        $role = $request->user->role ?? 'user';

        $source = $this->repo->findById($id);
        if (!$source || ($role !== 'admin' && $source->user_id !== $userId)) {
            return $this->redirect('/sources');
        }

        return $this->view('sources/edit', [
            'title' => 'Редагувати джерело',
            'source' => $source,
        ]);
    }

    #[Route('update/{id}', 'POST')]
    public function update(int $id, Request $request): Response
    {
        $userId = $request->user->id ?? 0;
        $role = $request->user->role ?? 'user';

        $existing = $this->repo->findById($id);
        if (!$existing || ($role !== 'admin' && $existing->user_id !== $userId)) {
            return $this->redirect('/sources');
        }
        $this->repo->update(new Source(
            user_id: (int) ($request->user->id ?? 1),
            name: $request->post('name'),
            balance: (float) $request->post('balance', 0),
            id: $id,
        ));

        return $this->redirect('/sources');
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

        return $this->redirect('/sources');
    }
}
