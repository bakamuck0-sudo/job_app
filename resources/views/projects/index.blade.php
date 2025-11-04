<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мои Проекты
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-4 flex justify-between">
                        <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600">
                            + Создать Проект
                        </a>
                    </div>

                    @forelse ($projects as $project)
                        <div class="mb-4 p-4 border rounded-lg shadow-sm">
                            <h3 class="text-lg font-bold">
                                <a href="{{ route('projects.show', $project)}}" class="text-blue-600 hover:text-blue-800">{{ $project->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mt-1">{{ $project->description }}</p>
                            <p class="text-sm mt-2 text-gray-500">Создан: {{ $project->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">У вас пока нет ни одного проекта. Создайте первый!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
