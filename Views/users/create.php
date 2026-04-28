<div class="max-w-lg">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Новий користувач</h1>

    <form method="POST" action="<?= url('users/store') ?>" class="bg-white border border-gray-200 rounded p-6 space-y-4">

        <div>
            <label class="block text-sm text-gray-600 mb-1">Ім'я</label>
            <input type="text" name="name" required
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Email</label>
            <input type="email" name="email" required
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Пароль</label>
            <input type="password" name="password" required
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Роль</label>
            <select name="role" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700">Зберегти</button>
            <a href="<?= url('users') ?>" class="text-sm text-gray-500 px-4 py-2 hover:underline">Скасувати</a>
        </div>
    </form>
</div>
