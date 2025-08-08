@extends('layouts.dashboard')

@section('title', 'لوحة التحكم')
@section('page-title', Carbon\Carbon::now()->translatedFormat('F Y'))

@section('content')
<div class="space-y-4 md:space-y-6 lg:space-y-8">
    {{-- Top Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        {{-- إجمالي المشاريع --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-charity-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-project-diagram text-charity-600 text-xl"></i>
                </div>
                <span class="text-sm text-gray-400">المشاريع</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <h4 class="text-2xl font-bold text-gray-900">{{ number_format($projectStats['total']) }}</h4>
                    <p class="text-sm text-gray-500">إجمالي المشاريع</p>
                </div>
                <div class="text-right">
                    <span class="text-sm font-semibold text-green-600">{{ number_format($projectStats['active']) }}</span>
                    <p class="text-xs text-gray-400">نشط</p>
                </div>
            </div>
        </div>

        {{-- إجمالي التبرعات --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-hand-holding-heart text-green-600 text-xl"></i>
                </div>
                <span class="text-sm text-gray-400">التبرعات</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <h4 class="text-2xl font-bold text-gray-900">{{ number_format($projectStats['total_amount']) }}</h4>
                    <p class="text-sm text-gray-500">إجمالي التبرعات</p>
                </div>
                <div class="text-right">
                    <span class="text-sm font-semibold text-green-600">{{ number_format($projectStats['total_donations']) }}</span>
                    <p class="text-xs text-gray-400">عملية</p>
                </div>
            </div>
        </div>

        {{-- المستخدمين --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <span class="text-sm text-gray-400">المستخدمين</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <h4 class="text-2xl font-bold text-gray-900">{{ number_format($userStats['total']) }}</h4>
                    <p class="text-sm text-gray-500">إجمالي المستخدمين</p>
                </div>
                <div class="text-right">
                    <span class="text-sm font-semibold text-blue-600">{{ number_format($userStats['donors']) }}</span>
                    <p class="text-xs text-gray-400">متبرع</p>
                </div>
            </div>
        </div>

        {{-- المتطوعين --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-hands-helping text-purple-600 text-xl"></i>
                </div>
                <span class="text-sm text-gray-400">المتطوعين</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <h4 class="text-2xl font-bold text-gray-900">{{ number_format($userStats['volunteers']) }}</h4>
                    <p class="text-sm text-gray-500">إجمالي المتطوعين</p>
                </div>
                <div class="text-right">
                    <span class="text-sm font-semibold text-purple-600">{{ number_format($userStats['beneficiaries']) }}</span>
                    <p class="text-xs text-gray-400">مستفيد</p>
                </div>
            </div>
        </div>
    </div>

    {{-- المشاريع النشطة --}}
    <div class="text-2xl lg:text-3xl font-bold text-gray-900 mb-6">
        المشاريع النشطة
    </div>

    {{-- Main Grid Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 xl:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
        {{-- Project Cards Section --}}
        <div class="lg:col-span-3 xl:col-span-3 space-y-4 md:space-y-6">
            {{-- Grid of Project Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6">
                @foreach($activeProjects as $project)
                <div class="bg-white rounded-3xl p-4 md:p-6 lg:p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-gray-200 transition-all duration-300 group">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex-1">
                            <h3 class="text-lg lg:text-xl font-bold text-gray-900 mb-2">{{ $project['title'] }}</h3>
                            <p class="text-gray-500 text-sm lg:text-base">{{ $project['description'] }}</p>
                            <p class="text-gray-400 text-xs lg:text-sm mt-1">{{ $project['category'] }}</p>
                        </div>
                        <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl transition-all duration-300">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>

                    {{-- Status Badge --}}
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-gray-600 text-sm font-medium">الحالة</span>
                        <span class="px-3 py-1 {{ $project['status_color'] }} rounded-full text-xs font-semibold">{{ $project['status_text'] }}</span>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs text-gray-500">التقدم</span>
                            <span class="text-xs font-semibold text-gray-700">{{ $project['progress'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r {{ $project['progress_color'] }} h-2 rounded-full transition-all duration-500" style="width: {{ $project['progress'] }}%"></div>
                        </div>
                    </div>

                    {{-- Date Range --}}
                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-400">{{ $project['date_range'] }}</span>
                        <span class="text-xs font-semibold text-gray-700">{{ $project['progress'] }}%</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Sidebar Section --}}
        <div class="lg:col-span-1 xl:col-span-1 space-y-4 md:space-y-6">
            {{-- Calendar Widget --}}
            <div class="bg-gradient-to-br from-charity-500 via-charity-600 to-charity-700 rounded-3xl p-4 md:p-6 lg:p-8 text-white shadow-lg">
                {{-- Calendar Header --}}
                <div class="flex items-center justify-between mb-8">
                    <button class="p-2 hover:bg-white hover:bg-opacity-20 rounded-xl transition-all duration-300">
                        <i class="fas fa-chevron-left text-white"></i>
                    </button>
                    <h3 class="text-xl font-bold">{{ $current_month }}</h3>
                    <button class="p-2 hover:bg-white hover:bg-opacity-20 rounded-xl transition-all duration-300">
                        <i class="fas fa-chevron-right text-white"></i>
                    </button>
                </div>

                {{-- Calendar Content --}}
                @include('admin.partials.calendar')
            </div>

            {{-- Notifications --}}
            <div class="bg-white rounded-3xl p-4 md:p-6 lg:p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">الإشعارات</h3>
                    @if($unread_notifications_count > 0)
                    <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                    @endif
                </div>

                <div class="space-y-4">
                    @foreach($notifications as $notification)
                    <div class="flex items-start gap-4 p-4 hover:bg-gray-50 rounded-2xl transition-all duration-300">
                        <div class="w-10 h-10 {{ $notification['icon_bg'] }} rounded-2xl flex items-center justify-center flex-shrink-0">
                            <i class="{{ $notification['icon'] }} {{ $notification['icon_color'] }}"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 text-sm">{{ $notification['title'] }}</h4>
                            <p class="text-gray-500 text-xs mt-1">{{ $notification['message'] }}</p>
                            <p class="text-gray-400 text-xs mt-2">{{ $notification['time_ago'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Team Members Widget --}}
            <div class="bg-white rounded-3xl p-4 md:p-6 lg:p-8 shadow-sm border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-6">أعضاء الفريق</h3>

                <div class="space-y-4">
                    @foreach($team_members as $member)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 {{ $member['avatar_bg'] }} rounded-2xl flex items-center justify-center text-white font-bold text-sm shadow-md">
                                {{ $member['initials'] }}
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm">{{ $member['name'] }}</h4>
                                <p class="text-gray-500 text-xs">{{ $member['role'] }}</p>
                            </div>
                        </div>
                        <div class="w-3 h-3 {{ $member['status_color'] }} rounded-full"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
