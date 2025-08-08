@props(['title', 'subtitle' => '', 'breadcrumbs' => []])

@extends('layouts.dashboard')

@section('page-title', $title)

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">{{ $title }}</h1>
                @if($subtitle)
                    <p class="text-gray-600 mt-2">{{ $subtitle }}</p>
                @endif

                {{-- Breadcrumbs --}}
                @if(count($breadcrumbs) > 0)
                    <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                            <i class="fas fa-home"></i>
                        </a>
                        @foreach($breadcrumbs as $breadcrumb)
                            <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                            @if($loop->last)
                                <span class="text-gray-700 font-medium">{{ $breadcrumb['name'] }}</span>
                            @else
                                <a href="{{ $breadcrumb['url'] }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                                    {{ $breadcrumb['name'] }}
                                </a>
                            @endif
                        @endforeach
                    </nav>
                @endif
            </div>

            {{-- Action Buttons --}}
            @if(isset($headerActions))
                <div class="flex items-center gap-3">
                    {{ $headerActions }}
                </div>
            @endif
        </div>
    </div>

    {{-- Page Content --}}
    {{ $slot }}
</div>
@endsection
