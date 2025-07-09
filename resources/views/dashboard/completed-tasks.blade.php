@extends('layout.master')

@section('title', 'Glimsol Task Management | Completed Tasks')

@section('body')
    @include('layout.navbar')
    
    @include('layout.sidebar')

    <div class="ml-15 lg:ml-50 mt-20 flex justify-center">
        <div class="container">
            <div class="p-1">
                <div class="relative m-5 p-8 bg-[#E8F8FF] rounded-xl min-h-150">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="font-bold text-3xl mb-2">
                                Completed Tasks
                            </div>
                        </div>
                        <div>
                            <button data-modal-target="create-task-modal" data-modal-toggle="create-task-modal" class="text-white font-bold bg-blue-400 w-25 hover:bg-blue-500 cursor-pointer inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-full text-sm py-2 lg:me-5 text-center" type="button">
                                <i class="fa-solid fa-plus mr-2"></i>
                                Create
                            </button>

                            <!-- Create task modal -->
                            <div id="create-task-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                Create New Task
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="create-task-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        {{-- Create task form --}}
                                        <form method="POST" action="{{ route('tasks.store') }}" id="createTask" class="p-4 md:p-5">
                                            @csrf
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                                                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type task title" required>
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900">Due Date</label>
                                                    <input type="date" name="due_date" id="due_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description (Optional)</label>
                                                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write a description here"></textarea>                    
                                                </div>
                                            </div>
                                            <div class="flex justify-end gap-1">
                                                <button type="button" class="text-white inline-flex items-center bg-blue-400 hover:bg-blue-300 cursor-pointer focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center" data-modal-toggle="create-task-modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="text-white inline-flex items-center bg-blue-500 hover:bg-blue-600 cursor-pointer focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center">
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Name sorting button --}}
                    <div class="flex flex-row mb-2 justify-end gap-1">
                        <a onclick="sortByName()" class="flex flex-row items-center rounded-lg select-none p-2 cursor-pointer hover:bg-[#C8EAFF]">
                            Name
                            <svg id="sort-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 ml-1 transition-transform duration-200">
                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v16.19l2.47-2.47a.75.75 0 1 1 1.06 1.06l-3.75 3.75a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 1 1 1.06-1.06l2.47 2.47V3a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    {{-- Tasks cards --}}
                    <div id="tasks" class="flex flex-wrap justify-center md:justify-start mt-3 gap-5 pb-10">
                        @if ($completedTasks->isNotEmpty())
                            @foreach ($completedTasks as $task)
                                <div class="task-card grid grid-cols-1 bg-white rounded-xl p-4 shadow-lg h-40 w-40 select-none hover:bg-gray-50" data-id="{{ $task->id }}" id="task-{{ $task->id }}" title="{{ $task->title }}">
                                    <div class="flex items-start justify-between">
                                        <div class="bg-green-200 rounded-full text-xs font-light px-3 py-0.5">
                                            Completed
                                        </div>
                                        <div>
                                            <div class="flex justify-end">
                                                <button id="optionButton-{{ $task->id }}" type="button" data-dropdown-toggle="optionDropdown-{{ $task->id }}" class="cursor-pointer hover:bg-gray-200 rounded-lg" onclick="event.stopPropagation()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-gray-400">
                                                        <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <!-- Dropdown menu -->
                                                <div id="optionDropdown-{{ $task->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm">
                                                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="optionButton-{{ $task->id }}">
                                                        <li>
                                                            <button type="button" onclick="markAsPending({{ $task->id }})" class="block px-4 py-2 cursor-pointer hover:bg-gray-100 text-start w-full">
                                                                Mark As Pending
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" data-modal-target="modal-{{ $task->id }}" data-modal-toggle="modal-{{ $task->id }}" onclick="populateEditForm(this)" data-id="{{ $task->id }}" data-title="{{ $task->title }}" data-due-date="{{ $task->due_date }}" data-description="{{ $task->description }}" class="block px-4 py-2 cursor-pointer hover:bg-gray-100 text-start w-full">
                                                                View
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" onclick="confirmDelete({{ $task->id }})" class="block px-4 py-2 cursor-pointer hover:bg-gray-100 text-start w-full">
                                                                Delete
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Edit task modal -->
                                                <div id="modal-{{ $task->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow-sm">
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                                                <h3 class="text-lg text-gray-900">
                                                                    Task: <span id="task-title-{{ $task->id }}" class="font-bold"></span>
                                                                </h3>
                                                                <button type="button" onclick="closeEdit({{ $task->id }})" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 cursor-pointer rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="modal-{{ $task->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ route('tasks.update', $task->id) }}" id="editTask" class="p-4 md:p-5">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                                    <div class="col-span-2">
                                                                        <label for="edit-title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                                                                        <input type="text" name="title" id="edit-title-{{ $task->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type task title" required readonly>
                                                                    </div>
                                                                    <div class="col-span-2">
                                                                        <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900">Due Date</label>
                                                                        <input type="date" name="due_date" id="edit-due-date-{{ $task->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required readonly>
                                                                    </div>
                                                                    <div class="col-span-2">
                                                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description (Optional)</label>
                                                                        <textarea id="edit-description-{{ $task->id }}" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write a description here" readonly></textarea>                    
                                                                    </div>
                                                                </div>
                                                                <div class="flex justify-end gap-1">
                                                                    <button type="button" id="close-edit-button-{{ $task->id }}" onclick="closeEdit({{ $task->id }})" class="text-white inline-flex items-center bg-blue-400 hover:bg-blue-300 cursor-pointer focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center" data-modal-toggle="modal-{{ $task->id }}">
                                                                        Close
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-end">
                                        <div class="text-lg font-bold overflow-hidden overflow-ellipsis whitespace-normal line-clamp-2" id="task-name-">
                                            {{ $task->title }}
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            Done at: {{ \Carbon\Carbon::parse($task->updated_at)->format('M d Y') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-xl font-medium text-center w-full mt-3">
                                No completed tasks
                            </div>
                        @endif
                    </div>
                    <div class="absolute bottom-5 right-5">
                        {{ $completedTasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = "{{ csrf_token() }}";
    </script>

    <script src="{{ asset('js/createTasks.js') }}"></script>
    <script src="{{ asset('js/editTasks.js') }}"></script>
    <script src="{{ asset('js/markTasks.js') }}"></script>
    <script src="{{ asset('js/sort.js') }}"></script>
@endsection