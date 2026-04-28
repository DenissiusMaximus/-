<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-semibold text-gray-800">Користувачі</h1>
    <a href="<?= url('users/create') ?>" class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700">+ Додати</a>
</div>

<div class="bg-white rounded border border-gray-200 overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Ім'я</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Роль</th>
                <th class="px-4 py-3">Дії</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($users as $u): ?>
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-500"><?= $u->id ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($u->name) ?></td>
                <td class="px-4 py-3 text-gray-600"><?= htmlspecialchars($u->email) ?></td>
                <td class="px-4 py-3">
                    <span class="px-2 py-0.5 rounded text-xs <?= $u->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-600' ?>">
                        <?= htmlspecialchars($u->role) ?>
                    </span>
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="<?= url('users/edit/' . $u->id) ?>" class="text-blue-600 hover:underline text-xs">Редагувати</a>
                    <form method="POST" action="<?= url('users/delete/' . $u->id) ?>" onsubmit="return confirm('Видалити?')">
                        <button class="text-red-500 hover:underline text-xs">Видалити</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($users)): ?>
            <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Користувачів немає</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
