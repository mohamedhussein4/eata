@props(['title', 'value', 'icon', 'color' => 'blue', 'trend' => '', 'trendValue' => ''])

@php
$colors = [
    'blue' => 'from-blue-500 to-blue-600',
    'green' => 'from-green-500 to-green-600',
    'purple' => 'from-purple-500 to-purple-600',
    'orange' => 'from-orange-500 to-orange-600',
    'red' => 'from-red-500 to-red-600',
    'indigo' => 'from-indigo-500 to-indigo-600',
    'pink' => 'from-pink-500 to-pink-600',
    'yellow' => 'from-yellow-500 to-yellow-600',
];

$gradientClass = $colors[$color] ?? $colors['blue'];
@endphp

<div class="bg-gradient-to-r {{ $gradientClass }} rounded-3xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105">
    <div class="flex items-center justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium opacity-90">{{ $title }}</p>
            <p class="text-3xl lg:text-4xl font-bold mt-2">{{ $value }}</p>

            @if($trend && $trendValue)
                <div class="flex items-center mt-4">
                    <i class="fas fa-arrow-{{ $trend === 'up' ? 'up' : 'down' }} text-sm {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    <span class="text-sm font-medium">{{ $trendValue }}</span>
                    <span class="text-sm opacity-75 {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }}">هذا الشهر</span>
                </div>
            @endif
        </div>

        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm group-hover:bg-opacity-30 transition-all duration-300">
            <i class="{{ $icon }} text-2xl"></i>
        </div>
    </div>
</div>
