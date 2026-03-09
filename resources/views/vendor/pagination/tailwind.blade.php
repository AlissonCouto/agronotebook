@if ($paginator->hasPages())

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

    <div class="text-sm text-gray-600">

        Mostrando
        <span class="font-medium">{{ $paginator->firstItem() }}</span>
        até
        <span class="font-medium">{{ $paginator->lastItem() }}</span>
        de
        <span class="font-medium">{{ $paginator->total() }}</span>
        resultados

    </div>

    <nav class="flex items-center gap-1">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())

        <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded">
            ‹
        </span>

        @else

        <a
            href="{{ $paginator->previousPageUrl() }}"
            class="px-3 py-1 text-sm bg-white border rounded hover:bg-gray-50">

            ‹

        </a>

        @endif


        {{-- Pagination Elements --}}
        @foreach ($elements as $element)

        {{-- Separator --}}
        @if (is_string($element))

        <span class="px-2 text-gray-400">
            {{ $element }}
        </span>

        @endif


        {{-- Links --}}
        @if (is_array($element))

        @foreach ($element as $page => $url)

        @if ($page == $paginator->currentPage())

        <span class="px-3 py-1 text-sm bg-emerald-600 text-white rounded">
            {{ $page }}
        </span>

        @else

        <a
            href="{{ $url }}"
            class="px-3 py-1 text-sm bg-white border rounded hover:bg-gray-50">

            {{ $page }}

        </a>

        @endif

        @endforeach

        @endif

        @endforeach


        {{-- Next --}}
        @if ($paginator->hasMorePages())

        <a
            href="{{ $paginator->nextPageUrl() }}"
            class="px-3 py-1 text-sm bg-white border rounded hover:bg-gray-50">

            ›

        </a>

        @else

        <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded">
            ›
        </span>

        @endif

    </nav>

</div>

@endif