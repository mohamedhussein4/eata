@extends('layouts.dashboard')

@section('page-title', 'تعديل الدور')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تعديل الدور</h1>
                <p class="text-gray-600 mt-2">تعديل دور: {{ $role->name }}</p>
                
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.roles.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">الأدوار</a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تعديل الدور</span>
                </nav>
            </div>
            
            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Current Role Info --}}
    <div class="bg-cyan-50 border border-cyan-200 rounded-3xl p-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-cyan-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user-shield text-white"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-cyan-900 mb-2">معلومات الدور الحالية</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-cyan-700 font-medium">اسم الدور:</span>
                        <p class="text-cyan-900 font-mono">{{ $role->name }}</p>
                    </div>
                    <div>
                        <span class="text-cyan-700 font-medium">معرف الدور:</span>
                        <p class="text-cyan-900">#{{ $role->id }}</p>
                    </div>
                    <div>
                        <span class="text-cyan-700 font-medium">تاريخ الإنشاء:</span>
                        <p class="text-cyan-900">{{ $role->created_at->format('Y-m-d') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Form Header --}}
            <div class="border-b border-gray-200 pb-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">تعديل معلومات الدور</h2>
                        <p class="text-gray-600 text-sm">قم بتحديث المعلومات حسب الحاجة</p>
                    </div>
                </div>
            </div>

            {{-- Role Information --}}
            <div class="space-y-6">
                {{-- Role Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag text-cyan-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        اسم الدور <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" required
                           value="{{ old('name', $role->name) }}"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-300 @error('name') border-red-500 @enderror"
                           placeholder="أدخل اسم الدور (مثل: Admin, Editor, Moderator)">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-info-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        يُفضل استخدام أسماء باللغة الإنجليزية للأدوار التقنية
                    </p>
                </div>

                {{-- Role Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        وصف الدور (اختياري)
                    </label>
                    <textarea id="description" name="description" rows="4"
                              class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-300 resize-none @error('description') border-red-500 @enderror"
                              placeholder="أدخل وصف مختصر للدور وصلاحياته...">{{ old('description', $role->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role Statistics --}}
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h3 class="font-bold text-gray-900 mb-4">
                        <i class="fas fa-chart-bar text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        إحصائيات الدور
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-green-600 text-sm"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">عدد المستخدمين</h4>
                            </div>
                            <p class="text-2xl font-bold text-green-600">{{ \App\Models\User::where('type', $role->name)->count() }}</p>
                            <p class="text-gray-600 text-xs">مستخدم بهذا الدور</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar text-blue-600 text-sm"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">تاريخ الإنشاء</h4>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ $role->created_at->format('Y-m-d') }}</p>
                            <p class="text-gray-600 text-xs">{{ $role->created_at->diffForHumans() }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-edit text-purple-600 text-sm"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">آخر تحديث</h4>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ $role->updated_at->format('Y-m-d') }}</p>
                            <p class="text-gray-600 text-xs">{{ $role->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                {{-- Role Settings --}}
                <div class="space-y-4">
                    <h3 class="font-bold text-gray-900">
                        <i class="fas fa-cog text-gray-600 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        إعدادات الدور
                    </h3>
                    
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">حالة الدور</h4>
                            <p class="text-sm text-gray-600">تفعيل أو إلغاء تفعيل الدور</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $role->is_active ?? true) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-cyan-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-cyan-600"></div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.roles.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    إلغاء
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>

    {{-- Delete Section --}}
    <div class="bg-red-50 border border-red-200 rounded-3xl p-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-red-900 mb-2">منطقة خطر</h3>
                <p class="text-red-700 text-sm mb-4">حذف الدور عملية غير قابلة للتراجع. تأكد من عدم وجود مستخدمين مرتبطين بهذا الدور قبل الحذف.</p>
                @if(\App\Models\User::where('type', $role->name)->count() > 0)
                    <div class="bg-yellow-100 border border-yellow-300 rounded-2xl p-4 mb-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                            <span class="text-yellow-800 text-sm font-medium">
                                تحذير: يوجد {{ \App\Models\User::where('type', $role->name)->count() }} مستخدم مرتبط بهذا الدور
                            </span>
                        </div>
                    </div>
                @endif
                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('هل أنت متأكد من حذف هذا الدور؟ هذا الإجراء لا يمكن التراجع عنه!')"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            @if(\App\Models\User::where('type', $role->name)->count() > 0) disabled @endif>
                        <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        حذف الدور نهائياً
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-suggest role descriptions
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    
    nameInput.addEventListener('input', function() {
        const value = this.value.toLowerCase();
        let suggestion = '';
        
        if (value.includes('admin')) {
            suggestion = 'مدير النظام مع صلاحيات كاملة للوصول وإدارة جميع أجزاء الموقع';
        } else if (value.includes('editor')) {
            suggestion = 'محرر المحتوى مع صلاحيات إنشاء وتعديل المقالات والصفحات';
        } else if (value.includes('moderator')) {
            suggestion = 'مشرف مع صلاحيات مراجعة وإدارة التعليقات والمحتوى المقدم من المستخدمين';
        } else if (value.includes('user')) {
            suggestion = 'مستخدم عادي مع صلاحيات أساسية للتصفح والتفاعل';
        }
        
        if (suggestion && !descriptionInput.value) {
            descriptionInput.placeholder = suggestion;
        }
    });
});
</script>
@endsection