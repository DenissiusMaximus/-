<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-semibold text-gray-800">Адміністратори</h1>
    <a href="<?= url('auth/addAdmin') ?>" class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700">+ Додати адміна</a>
</div>

<div class="bg-white rounded border border-gray-200 overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Ім'я</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Дії</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($admins as $admin): ?>
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-500"><?= $admin->id ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($admin->name) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($admin->email) ?></td>
                <td class="px-4 py-3 flex gap-2">
                    <?php if ($admin->id !== ($_SESSION['user_id'] ?? 0)): ?>
                    <form method="POST" action="<?= url('auth/deleteAdmin/' . $admin->id) ?>" onsubmit="return confirm('Видалити адміністратора?')">
                        <button class="text-red-500 hover:underline text-xs">Видалити</button>
                    </form>
                    <?php else: ?>
                        <span class="text-gray-400 text-xs">Це ви</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
