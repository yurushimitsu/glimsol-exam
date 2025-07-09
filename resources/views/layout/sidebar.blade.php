<div class="fixed top-25 ms-3 lg:hidden bg-white">
    <ul class="space-y-2 pt-3 font-medium">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="z-20 inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-[#5BD0F4] hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <i class="fa-solid fa-bars fa-lg w-6 h-6"></i>
        </button>
        <li>
           <a href="{{ route('tasks.index') }}" class="flex items-center justify-center py-5 text-gray-900 rounded-xl hover:bg-[#5BD0F4] hover:text-white {{ (Route::is('tasks.index')) ? 'bg-[#5BD0F4] text-white' : '' }} focus:outline-none focus:ring-2 focus:ring-gray-200 group">
                <i class="fa-solid fa-list fa-lg text-gray-500 {{ (Route::is('tasks.index')) ? 'text-white' : '' }}"></i>
           </a>
        </li>
        <li>
            <a href="{{ route('completed.index') }}" class="flex items-center justify-center py-5 text-gray-900 rounded-xl hover:bg-[#5BD0F4] hover:text-white {{ (Route::is('completed.index')) ? 'bg-[#5BD0F4] text-white' : '' }} focus:outline-none focus:ring-2 focus:ring-gray-200 group">
                <i class="fa-solid fa-circle-check fa-lg text-gray-500 {{ (Route::is('completed.index')) ? 'text-white' : '' }}"></i>                 
            </a>
        </li>
        <li>
            <a href="{{ route('overdue.index') }}" class="flex items-center justify-center py-5 text-gray-900 rounded-xl hover:bg-[#5BD0F4] hover:text-white {{ (Route::is('overdue.index')) ? 'bg-[#5BD0F4] text-white' : '' }} focus:outline-none focus:ring-2 focus:ring-gray-200 group">
                <i class="fa-solid fa-circle-exclamation fa-lg text-gray-500 {{ (Route::is('overdue.index')) ? 'text-white' : '' }}"></i>
            </a>
        </li>
    </ul>
</div>
 
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 md:z-0 w-50 h-screen transition-transform -translate-x-full lg:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-5 pt-20 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium pt-5">
            <li>
                <a href="{{ route('tasks.index') }}" class="flex items-center p-3 text-gray-900 rounded-xl hover:bg-[#5BD0F4] hover:text-white {{ (Route::is('tasks.index')) ? 'bg-[#5BD0F4] text-white' : '' }} focus:outline-none focus:ring-2 focus:ring-gray-200 group">
                    <i class="fa-solid fa-list fa-lg text-gray-500 group-hover:text-white {{ (Route::is('tasks.index')) ? 'text-white' : '' }}"></i>
                    <span class="ms-3">Tasks</span>
                </a>
            </li>
            <li>
                <a href="{{ route('completed.index') }}" class="flex items-center p-3 text-gray-900 rounded-xl hover:bg-[#5BD0F4] hover:text-white {{ (Route::is('completed.index')) ? 'bg-[#5BD0F4] text-white' : '' }} focus:outline-none focus:ring-2 focus:ring-gray-200 group">
                    <i class="fa-solid fa-circle-check fa-lg text-gray-500 group-hover:text-white {{ (Route::is('completed.index')) ? 'text-white' : '' }}"></i>                 
                   <span class="ms-3">Completed</span>
                </a>
            </li>
            <li>
                <a href="{{ route('overdue.index') }}" class="flex items-center p-3 text-gray-900 rounded-xl hover:bg-[#5BD0F4] hover:text-white {{ (Route::is('overdue.index')) ? 'bg-[#5BD0F4] text-white' : '' }} focus:outline-none focus:ring-2 focus:ring-gray-200 group">
                    <i class="fa-solid fa-circle-exclamation fa-lg text-gray-500 group-hover:text-white {{ (Route::is('overdue.index')) ? 'text-white' : '' }}"></i>
                   <span class="ms-3">Overdue</span>
                </a>
            </li>
        </ul>
    </div>
</aside>