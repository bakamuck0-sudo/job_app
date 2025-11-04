<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
Проект: {{ $project->title }}
</h2>
</x-slot>

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">

<div class="mb-8 border-b pb-4">
<p class="text-lg font-medium text-gray-700">{{ $project->description }}</p>
</div>

<h3 class="text-xl font-bold mb-4">Список Задач</h3>

<form method="POST" action="{{ route('tasks.store', $project) }}" class="mb-6 flex">
@csrf
<input name="body" class="flex-grow border-gray-300 rounded-l-md shadow-sm" type="text" placeholder="Новая задача..." required />

<button type="submit" class="px-4 py-2 bg-blue-500 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600">
Добавить
</button>
</form>

<div class="space-y-3">
@forelse ($project->tasks()->latest()->get() as $task)
<div class="flex items-center justify-between p-3 border rounded-lg {{ $task->completed ? 'bg-gray-100' : 'bg-white' }}">

<form method="POST" action="{{ route('tasks.update', [$project, $task]) }}">
@csrf
@method('PATCH')
<label class="flex items-center">
<input
type="checkbox"
name="completed"
class="rounded border-gray-300 text-indigo-600 shadow-sm"
onchange="this.form.submit()"
{{ $task->completed ? 'checked' : '' }}
>
<span class="ml-2 {{ $task->completed ? 'line-through text-gray-500' : 'text-gray-900' }}">
{{ $task->body }}
</span>
</label>
</form>

<span class="text-xs text-gray-400">
Создана: {{ $task->created_at->diffForHumans() }}
</span>
</div>
@empty
<p class="text-gray-500">В этом проекте пока нет задач. Добавьте первую!</p>
@endforelse
</div>

</div>
</div>
</div>
</div>
</x-app-layout>
