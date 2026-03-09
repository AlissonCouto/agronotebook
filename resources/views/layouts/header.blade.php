<header class="h-16 bg-white border-b flex items-center justify-between px-6">

    <div class="flex items-center gap-4">

        <button
            @click="sidebarOpen = !sidebarOpen"
            class="text-gray-600 hover:text-black">

            ☰ </button>

        <h1 class="text-gray-800 font-semibold">
            {{ $title ?? 'Dashboard' }}
        </h1>

    </div>

    <div class="flex items-center gap-6">

        <div class="flex items-center gap-2 text-sm text-gray-600">
            <span>{{ auth()->user()->name ?? 'Usuário' }}</span>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-500 text-sm hover:underline">
                Sair
            </button>
        </form>

    </div>

</header>