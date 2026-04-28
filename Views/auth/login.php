<?php $title = 'Авторизація'; ?>
<div class="max-w-md mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-center">Авторизація</h1>

    <?php if (isset($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="<?= url('auth/login') ?>" method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Електронна пошта</label>
            <input type="email" name="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Пароль</label>
            <input type="password" name="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Увійти
        </button>
    </form>
    
    <div class="mt-4 text-center">
        <a href="<?= url('auth/register') ?>" class="text-blue-600 hover:text-blue-800">Ще не зареєстровані? Реєстрація</a>
    </div>
</div>
