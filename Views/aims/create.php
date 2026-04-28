<div class="max-w-lg">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Нова ціль</h1>

    <form method="POST" action="<?= url('aims/store') ?>" class="bg-white border border-gray-200 rounded p-6 space-y-4">

        <div>
            <label class="block text-sm text-gray-600 mb-1">Назва</label>
            <input type="text" name="name" required
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Сума цілі (грн)</label>
            <input type="number" step="0.01" name="target_amount" required
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Вже зібрано (грн)</label>
            <input type="number" step="0.01" name="current_amount" value="0"
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700">Зберегти</button>
            <a href="<?= url('aims') ?>" class="text-sm text-gray-500 px-4 py-2 hover:underline">Скасувати</a>
        </div>
    </form>
</div>
