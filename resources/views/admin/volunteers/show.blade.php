@extends('layouts.dashboard')

@section('page-title', 'تفاصيل المتطوع')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تفاصيل المتطوع</h1>
                <p class="text-gray-600 mt-2">معلومات المتطوع: {{ $volunteer->name }}</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.volunteers.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        المتطوعين
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تفاصيل</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.volunteers.edit', $volunteer->id) }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-edit {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تعديل المتطوع
                </a>
                <a href="{{ route('admin.volunteers.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Volunteer Information --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 lg:p-8">
            {{-- Volunteer Header --}}
            <div class="flex items-start gap-4 mb-6 pb-6 border-b border-gray-200">
                <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-heart text-white text-xl"></i>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $volunteer->name }}</h2>
                    <p class="text-gray-600">{{ $volunteer->email }}</p>
                    <div class="flex items-center gap-4 mt-2">
                        @if($volunteer->is_approved)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                موافق عليه
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                <i class="fas fa-clock {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                في انتظار الموافقة
                            </span>
                        @endif
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            العمر: {{ $volunteer->age }} سنة
                        </span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">رقم المتطوع</p>
                        <p class="text-lg font-bold text-gray-900">#{{ $volunteer->id }}</p>
                    </div>
                </div>
            </div>

            {{-- Volunteer Details --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Basic Information --}}
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-info-circle text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        المعلومات الأساسية
                    </h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">الاسم الكامل</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $volunteer->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">البريد الإلكتروني</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $volunteer->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">رقم الهاتف</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $volunteer->phone }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">العمر</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $volunteer->age }} سنة</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">العنوان</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $volunteer->address }}</dd>
                        </div>
                    </dl>
                </div>

                {{-- Volunteer Information --}}
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-heart text-red-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        معلومات التطوع
                    </h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">حالة الموافقة</dt>
                            <dd class="mt-1">
                                @if($volunteer->is_approved)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        موافق عليه
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                        <i class="fas fa-clock {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        في انتظار الموافقة
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">تاريخ التسجيل</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $volunteer->created_at->format('Y-m-d H:i:s') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">آخر تحديث</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $volunteer->updated_at->format('Y-m-d H:i:s') }}</dd>
                        </div>
                        @if($volunteer->cv)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">السيرة الذاتية</dt>
                                <dd class="mt-1">
                                    <a href="{{ asset('/' . $volunteer->cv) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-file-pdf {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        عرض السيرة الذاتية
                                    </a>
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            {{-- Skills and Experience --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-tools text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    المهارات والخبرة
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Skills --}}
                    <div class="bg-blue-50 rounded-2xl p-6">
                        <h4 class="font-semibold text-gray-900 mb-3">المهارات</h4>
                        <div class="text-sm text-gray-700">
                            @if($volunteer->skills)
                                {{ $volunteer->skills }}
                            @else
                                <span class="text-gray-500">لم يتم تحديد مهارات</span>
                            @endif
                        </div>
                    </div>

                    {{-- Experience --}}
                    <div class="bg-green-50 rounded-2xl p-6">
                        <h4 class="font-semibold text-gray-900 mb-3">الخبرة السابقة</h4>
                        <div class="text-sm text-gray-700">
                            @if($volunteer->experience)
                                {{ $volunteer->experience }}
                            @else
                                <span class="text-gray-500">لم يتم تحديد خبرة سابقة</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Motivation --}}
            @if($volunteer->motivation)
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-lightbulb text-yellow-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        الدافع للتطوع
                    </h3>
                    <div class="bg-yellow-50 rounded-2xl p-6">
                        <p class="text-sm text-gray-700">{{ $volunteer->motivation }}</p>
                    </div>
                </div>
            @endif

            {{-- Volunteer Actions --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        @if(!$volunteer->is_approved)
                            <form action="{{ route('admin.volunteers.approve', $volunteer->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-green-700 bg-green-100 hover:bg-green-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    الموافقة على التطوع
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.volunteers.reject', $volunteer->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-orange-700 bg-orange-100 hover:bg-orange-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500"
                                        onclick="return confirm('هل أنت متأكد من رفض هذا المتطوع؟')">
                                    <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    رفض التطوع
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        <form action="{{ route('admin.volunteers.destroy', $volunteer->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا المتطوع؟')">
                                <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                حذف المتطوع
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
