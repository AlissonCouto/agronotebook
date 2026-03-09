<aside
    :class="sidebarOpen ? 'w-64' : 'w-20'"
    class="bg-white border-r border-gray-200 transition-all duration-300 flex flex-col">

    <div class="h-16 flex items-center justify-center font-semibold text-gray-800 border-b">
        🌱 AgroNotebook
    </div>

    <nav class="flex-1 p-4 space-y-2 text-sm">

        <a href="/dashboard"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('dashboard') ? 'bg-gray-100 font-medium' : '' }}">

            <i class="fas fa-th-large"></i>

            <span x-show="sidebarOpen">Dashboard</span>

        </a>

        <a href="/farms"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('farms*') ? 'bg-gray-100 font-medium' : '' }}">

            <i class="fas fa-map-marked-alt"></i>

            <span x-show="sidebarOpen">Fazendas</span>

        </a>

        <a href="/fields"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('fields*') ? 'bg-gray-100 font-medium' : '' }}">

            <i class="fas fa-th"></i>

            <span x-show="sidebarOpen">Talhões</span>

        </a>

        <a href="/crops"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('crops*') ? 'bg-gray-100 font-medium' : '' }}">

            <i class="fas fa-seedling"></i>

            <span x-show="sidebarOpen">Culturas</span>

        </a>

        <a href="/applications"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('applications*') ? 'bg-gray-100 font-medium' : '' }}">

            <i class="fas fa-flask"></i>

            <span x-show="sidebarOpen">Aplicações</span>

        </a>

        <a href="/produtos"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('products*') ? 'bg-gray-100 font-medium' : '' }}">

            <i class="fas fa-box"></i>

            <span x-show="sidebarOpen">Produtos</span>

        </a>

        <a href="/users"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('users*') ? 'bg-gray-100 font-medium' : '' }}">

            <i class="fas fa-users"></i>

            <span x-show="sidebarOpen">Usuários</span>

        </a>

        <a href="/settings"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('settings*') ? 'bg-gray-100 font-medium' : '' }}">

            <i class="fas fa-cog"></i>

            <span x-show="sidebarOpen">Configurações</span>

        </a>

    </nav>

</aside>