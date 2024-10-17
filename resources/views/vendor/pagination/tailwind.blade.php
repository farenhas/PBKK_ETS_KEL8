@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-800 border border-gray-500 cursor-default leading-5 rounded-md">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-700 hover:bg-gray-600 border border-gray-500 leading-5 rounded-md">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-gray-800 border border-gray-500 cursor-default leading-5 rounded-md">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-gray-900 border border-gray-500 cursor-default leading-5 rounded-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-gray-700 hover:bg-gray-600 border border-gray-500 leading-5 rounded-md" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-gray-700 hover:bg-gray-600 border border-gray-500 leading-5 rounded-md">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-gray-800 border border-gray-500 cursor-default leading-5 rounded-md">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
