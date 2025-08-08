{{-- Days of Week --}}
<div class="grid grid-cols-7 gap-2 mb-4">
    @foreach(['أحد', 'اثن', 'ثلا', 'أرب', 'خمي', 'جمع', 'سبت'] as $day)
        <div class="text-center text-xs text-white/70">{{ $day }}</div>
    @endforeach
</div>

{{-- Calendar Grid --}}
<div class="grid grid-cols-7 gap-2">
    @php
        $firstDay = now()->startOfMonth();
        $lastDay = now()->endOfMonth();
        $startPadding = $firstDay->dayOfWeek;
        $totalDays = $firstDay->daysInMonth;
    @endphp

    {{-- Padding for start of month --}}
    @for($i = 0; $i < $startPadding; $i++)
        <div class="h-8 rounded-lg"></div>
    @endfor

    {{-- Days of month --}}
    @for($day = 1; $day <= $totalDays; $day++)
        @php
            $date = now()->setDay($day);
            $isToday = $date->isToday();
        @endphp
        <div class="relative">
            <button class="w-full h-8 flex items-center justify-center text-sm rounded-lg transition-all duration-300
                {{ $isToday ? 'bg-white text-charity-600 font-bold' : 'hover:bg-white/20' }}">
                {{ $day }}
            </button>
            @if($isToday)
                <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-1 h-1 bg-white rounded-full"></div>
            @endif
        </div>
    @endfor
</div> 