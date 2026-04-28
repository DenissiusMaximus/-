<div class="max-w-md mx-auto bg-white p-6 rounded border border-gray-200">
    <h1 class="text-xl font-semibold mb-6">Додати адміністратора</h1>

    <?php if (isset($error)): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="<?= url('auth/addAdmin') ?>" method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Ім'я</label>
            <input type="text" name="name" required class="w-full border-gray-300 rounded shadow-sm px-3 py-2 border focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" required class="w-full border-gray-300 rounded shadow-sm px-3 py-2 border focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Пароль</label>
            <input type="password" name="password" required class="w-full border-gray-300 rounded shadow-sm px-3 py-2 border focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Створити</button>
            <a href="<?= url('auth/seeAdmins') ?>" class="bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200 w-full text-center">Скасувати</a>
        </div>
    </form>
</div>
