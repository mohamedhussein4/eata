@extends('layouts.dashboard')

@section('page-title', 'تفاصيل المستخدم')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تفاصيل المستخدم</h1>
                <p class="text-gray-600 mt-2">معلومات المستخدم: {{ $user->name }}</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        المستخدمين
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تفاصيل</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-edit {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تعديل المستخدم
                </a>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- User Information --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 lg:p-8">
            {{-- User Header --}}
            <div class="flex items-start gap-4 mb-6 pb-6 border-b border-gray-200">
                <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                    @if($user->profile_image)
                        <img src="{{ asset($user->profile_image) }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full object-cover">
                    @else
                        <i class="fas fa-user text-white text-xl"></i>
                    @endif
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    <div class="flex items-center gap-4 mt-2">
                        @php
                            $role = $user->role ?? 'user';
                            $roleColors = [
                                'admin' => 'bg-purple-100 text-purple-800',
                                'user' => 'bg-blue-100 text-blue-800',
                            ];
                            $roleLabels = [
                                'admin' => 'مدير',
                                'user' => 'مستخدم',
                            ];
                            $status = $user->status ?? 'active';
                            $statusColors = [
                                'active' => 'bg-green-100 text-green-800',
                                'inactive' => 'bg-red-100 text-red-800',
                            ];
                            $statusLabels = [
                                'active' => 'نشط',
                                'inactive' => 'غير نشط',
                            ];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $roleColors[$role] }}">
                            {{ $roleLabels[$role] }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColors[$status] }}">
                            {{ $statusLabels[$status] }}
                        </span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">رقم المستخدم</p>
                        <p class="text-lg font-bold text-gray-900">#{{ $user->id }}</p>
                    </div>
                </div>
            </div>

            {{-- User Details --}}
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
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">البريد الإلكتروني</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">رقم الهاتف</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->phone ?? 'غير محدد' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">العنوان</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->address ?? 'غير محدد' }}</dd>
                        </div>
                    </dl>
                </div>

                {{-- Account Information --}}
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-shield-alt text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        معلومات الحساب
                    </h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">الدور</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $roleColors[$role] }}">
                                    {{ $roleLabels[$role] }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">الحالة</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColors[$status] }}">
                                    {{ $statusLabels[$status] }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">تاريخ التسجيل</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('Y-m-d H:i:s') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">آخر تحديث</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('Y-m-d H:i:s') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">تأكيد البريد الإلكتروني</dt>
                            <dd class="mt-1">
                                @if($user->email_verified_at)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        مؤكد
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        غير مؤكد
                                    </span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- User Statistics --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-chart-bar text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إحصائيات المستخدم
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-blue-50 rounded-2xl p-4 text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $user->donations()->count() ?? 0 }}</div>
                        <div class="text-sm text-blue-600">التبرعات</div>
                    </div>
                    <div class="bg-green-50 rounded-2xl p-4 text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $user->volunteers()->count() ?? 0 }}</div>
                        <div class="text-sm text-green-600">طلبات التطوع</div>
                    </div>
                    <div class="bg-purple-50 rounded-2xl p-4 text-center">
                        <div class="text-2xl font-bold text-purple-600">{{ $user->tickets()->count() ?? 0 }}</div>
                        <div class="text-sm text-purple-600">التذاكر</div>
                    </div>
                    <div class="bg-orange-50 rounded-2xl p-4 text-center">
                        <div class="text-2xl font-bold text-orange-600">{{ $user->testimonials()->count() ?? 0 }}</div>
                        <div class="text-sm text-orange-600">الآراء</div>
                    </div>
                </div>
            </div>

            {{-- User Actions --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        @if($user->status === 'active')
                            <form action="{{ route('admin.users.deactivate', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-orange-700 bg-orange-100 hover:bg-orange-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500"
                                        onclick="return confirm('هل أنت متأكد من إلغاء تفعيل هذا المستخدم؟')">
                                    <i class="fas fa-user-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    إلغاء التفعيل
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.activate', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-green-700 bg-green-100 hover:bg-green-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <i class="fas fa-user-check {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    تفعيل
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    onclick="return confirm('هل أنت متأكد من إعادة تعيين كلمة المرور؟')">
                                <i class="fas fa-key {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                إعادة تعيين كلمة المرور
                            </button>
                        </form>
                    </div>
                    <div class="flex items-center gap-3">
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                حذف المستخدم
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 