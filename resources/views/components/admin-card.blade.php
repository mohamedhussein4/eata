@props(['title' => '', 'subtitle' => '', 'icon' => '', 'padding' => 'p-6'])

<div class="bg-white rounded-3xl {{ $padding }} shadow-sm border border-gray-100 hover:shadow-xl hover:border-gray-200 transition-all duration-300 group">
    @if($title)
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                @if($icon)
                    <div class="w-10 h-10 bg-gradient-to-r from-slate-500 to-slate-600 rounded-2xl flex items-center justify-center text-white">
                        <i class="{{ $icon }} text-lg"></i>
                    </div>
                @endif
                <div>
                    <h3 class="text-lg font-bold text-gray-900">{{ $title }}</h3>
                    @if($subtitle)
                        <p class="text-sm text-gray-600">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>

            @if(isset($headerActions))
                <div class="flex items-center gap-2">
                    {{ $headerActions }}
                </div>
            @endif
        </div>
    @endif

    {{ $slot }}
</div>
