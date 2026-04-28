<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-semibold text-gray-800">Джерела коштів</h1>
    <a href="<?= url('sources/create') ?>" class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700">+ Додати</a>
</div>

<div class="bg-white rounded border border-gray-200 overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Назва</th>
                <th class="px-4 py-3">Баланс</th>
                <th class="px-4 py-3">Дії</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($sources as $src): ?>
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-500"><?= $src->id ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($src->name) ?></td>
                <td class="px-4 py-3 font-medium"><?= number_format($src->balance, 2) ?> грн</td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="<?= url('sources/edit/' . $src->id) ?>" class="text-blue-600 hover:underline text-xs">Редагувати</a>
                    <form method="POST" action="<?= url('sources/delete/' . $src->id) ?>" onsubmit="return confirm('Видалити?')">
                        <button class="text-red-500 hover:underline text-xs">Видалити</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($sources)): ?>
            <tr><td colspan="4" class="px-4 py-6 text-center text-gray-400">Джерел немає</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
