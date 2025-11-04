// app/Http/Controllers/TaskController.php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Сохраняет новую задачу для заданного проекта.
     */
    public function store(Request $request, Project $project)
    {
        // 1. Проверка прав (БЕЗОПАСНОСТЬ)
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        // 2. Валидация
        $validated = $request->validate([
            'body' => 'required|string|max:255',
        ]);

        // 3. Создаем задачу, привязанную к проекту
        $project->tasks()->create($validated);

        // 4. Возвращаемся на страницу проекта
        return back();
    }

    /**
     * Обновляет статус задачи (выполнено/не выполнено).
     */
    public function update(Project $project, Task $task)
    {
        // 1. Проверка прав (БЕЗОПАСНОСТЬ)
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        // 2. Меняем статус на противоположный
        $task->update([
            'completed' => !$task->completed,
        ]);

        // 3. Возвращаемся
        return back();
    }
}
