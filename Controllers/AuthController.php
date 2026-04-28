<?php

namespace Controllers;

use Core\Attributes\Route;
use Core\MVC\ControllerBase;
use Core\Request;
use Core\Response;
use Models\User;
use Repositories\Interfaces\IUserRepository;
use Repositories\UserRepository;
use Utils\Security\PasswordHasher;

#[Route('/auth')]
class AuthController extends ControllerBase
{
    private IUserRepository $user_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
    }

    #[Route('/seeAdmins', 'GET')]
    public function seeAdminsGet(Request $request): Response
    {
        if ($request->user->role !== 'admin') {
            return $this->redirect('/');
        }

        $allUsers = $this->user_repository->findAll();
        $admins = array_filter($allUsers, fn($u) => $u->role === 'admin');

        return $this->view('auth/seeAdmins', [
            'title' => 'Список адміністраторів',
            'admins' => $admins,
        ]);
    }

    #[Route('/addAdmin', 'GET')]
    public function addAdminGet(Request $request): Response
    {
        if ($request->user->role !== 'admin') {
            return $this->redirect('/');
        }

        return $this->view('auth/addAdmin', [
            'title' => 'Додати адміністратора',
        ]);
    }

    #[Route('/addAdmin', 'POST')]
    public function addAdminPost(Request $request): Response
    {
        if ($request->user->role !== 'admin') {
            return $this->redirect('/');
        }

        $name = $request->postData['name'] ?? '';
        $email = $request->postData['email'] ?? '';
        $password = $request->postData['password'] ?? '';

        if ($this->user_repository->findByEmail($email) !== null) {
            return $this->view('auth/addAdmin', [
                'title' => 'Додати адміністратора',
                'error' => 'Користувач з такою поштою вже існує'
            ], 400);
        }

        $password_hash = PasswordHasher::hash($password);
        $this->user_repository->create(new User($name, $email, $password_hash, 'admin'));

        return $this->redirect('/auth/seeAdmins');
    }

    #[Route('/deleteAdmin/{id}', 'POST')]
    public function deleteAdminPost(int $id, Request $request): Response
    {
        if ($request->user->role !== 'admin') {
            return $this->redirect('/');
        }

        if ($id === $request->user->id) {
            return $this->redirect('/auth/seeAdmins');
        }

        $this->user_repository->delete($id);

        return $this->redirect('/auth/seeAdmins');
    }

    #[Route('/login', 'GET')]
    public function showLogin(): Response
    {
        return $this->view('auth/login');
    }

    #[Route('/login', 'POST')]
    public function login(Request $request): Response
    {
        $email = $request->postData['email'] ?? '';
        $password = $request->postData['password'] ?? '';

        $user = $this->user_repository->findByEmail($email);

        if ($user !== null && PasswordHasher::verify($password, $user->password_hash)) {

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user->id;
            $_SESSION['role'] = $user->role;
            $_SESSION['email'] = $user->email;

            return Response::redirect('/');
        }

        return $this->view('auth/login', ['error' => 'Authorization error'], 401);
    }

    #[Route('/register', 'GET')]
    public function showRegister(): Response
    {
        return $this->view('auth/register');
    }

    #[Route('/register', 'POST')]
    public function register(Request $request): Response
    {
        $name = $request->postData['name'] ?? '';
        $email = $request->postData['email'] ?? '';
        $password = $request->postData['password'] ?? '';

        if ($this->user_repository->findByEmail($email) !== null) {
            return $this->view('auth/register', ['error' => 'Email already exists'], 400);
        }

        $password_hash = PasswordHasher::hash($password);
        $user = $this->user_repository->create(new User($name, $email, $password_hash, 'user'));

        if ($user) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user;
            $_SESSION['role'] = 'user';
            $_SESSION['email'] = $email;

            return Response::redirect('/');
        }

        return $this->view('auth/register', ['error' => 'Registration failed'], 500);
    }

    #[Route('/logout', 'GET')]
    public function logout(): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        return Response::redirect('/auth/login');
    }
}
