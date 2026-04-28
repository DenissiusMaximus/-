<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-semibold text-gray-800">Цілі</h1>
    <a href="<?= url('aims/create') ?>" class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700">+ Додати</a>
</div>

<div class="bg-white rounded border border-gray-200 overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Назва</th>
                <th class="px-4 py-3">Ціль (грн)</th>
                <th class="px-4 py-3">Зібрано (грн)</th>
                <th class="px-4 py-3">Прогрес</th>
                <th class="px-4 py-3">Дії</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($aims as $aim): ?>
            <?php $pct = $aim->target_amount > 0 ? min(100, round($aim->current_amount / $aim->target_amount * 100)) : 0; ?>
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-500"><?= $aim->id ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($aim->name) ?></td>
                <td class="px-4 py-3"><?= number_format($aim->target_amount, 2) ?></td>
                <td class="px-4 py-3"><?= number_format($aim->current_amount, 2) ?></td>
                <td class="px-4 py-3 w-32">
                    <div class="w-full bg-gray-200 rounded h-1.5">
                        <div class="bg-blue-500 h-1.5 rounded" style="width: <?= $pct ?>%"></div>
                    </div>
                    <span class="text-xs text-gray-400"><?= $pct ?>%</span>
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="<?= url('aims/edit/' . $aim->id) ?>" class="text-blue-600 hover:underline text-xs">Редагувати</a>
                    <form method="POST" action="<?= url('aims/delete/' . $aim->id) ?>" onsubmit="return confirm('Видалити?')">
                        <button class="text-red-500 hover:underline text-xs">Видалити</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($aims)): ?>
            <tr><td colspan="6" class="px-4 py-6 text-center text-gray-400">Цілей немає</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
