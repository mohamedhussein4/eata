@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-default rounded-full leading-5">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-charity-600 bg-white border border-gray-200 rounded-full leading-5 hover:text-charity-700 hover:bg-charity-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-charity-500 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-charity-600 bg-white border border-gray-200 rounded-full leading-5 hover:text-charity-700 hover:bg-charity-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-charity-500 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-default rounded-full leading-5">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
            <div>
                <span class="relative z-0 inline-flex gap-2">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-default rounded-full leading-5" aria-hidden="true">
                                <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-sm"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-charity-600 bg-white border border-gray-200 rounded-full leading-5 hover:text-white hover:bg-charity-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-sm"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-200 cursor-default rounded-full leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-charity-500 to-charity-600 border border-charity-500 cursor-default rounded-full leading-5 transition-all duration-300 min-w-[40px] justify-center">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-full leading-5 hover:text-white hover:bg-charity-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 transition ease-in-out duration-150 min-w-[40px] justify-center" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-charity-600 bg-white border border-gray-200 rounded-full leading-5 hover:text-white hover:bg-charity-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-charity-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-sm"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-default rounded-full leading-5" aria-hidden="true">
                                <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-sm"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif 