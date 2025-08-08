@extends('layouts.dashboard')

@section('page-title', 'إضافة دور جديد')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إضافة دور جديد</h1>
                <p class="text-gray-600 mt-2">إنشاء دور جديد لإدارة صلاحيات المستخدمين</p>
                
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.roles.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">الأدوار</a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">إضافة دور جديد</span>
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

    {{-- Form Section --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.roles.store') }}" method="POST" class="p-6 lg:p-8 space-y-6">
            @csrf

            {{-- Form Header --}}
            <div class="border-b border-gray-200 pb-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">معلومات الدور الجديد</h2>
                        <p class="text-gray-600 text-sm">املأ المعلومات التالية لإنشاء دور جديد</p>
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
                           value="{{ old('name') }}"
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
                              placeholder="أدخل وصف مختصر للدور وصلاحياته...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role Examples --}}
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h3 class="font-bold text-gray-900 mb-4">
                        <i class="fas fa-lightbulb text-yellow-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        أمثلة على الأدوار الشائعة
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-crown text-red-600 text-sm"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Admin</h4>
                            </div>
                            <p class="text-gray-600 text-sm">مدير النظام - صلاحيات كاملة</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-edit text-blue-600 text-sm"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Editor</h4>
                            </div>
                            <p class="text-gray-600 text-sm">محرر المحتوى - إدارة المقالات والصفحات</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-eye text-green-600 text-sm"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">Moderator</h4>
                            </div>
                            <p class="text-gray-600 text-sm">مشرف - مراجعة التعليقات والمحتوى</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-user text-purple-600 text-sm"></i>
                                </div>
                                <h4 class="font-bold text-gray-900">User</h4>
                            </div>
                            <p class="text-gray-600 text-sm">مستخدم عادي - صلاحيات محدودة</p>
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
                            <h4 class="text-sm font-medium text-gray-900">تفعيل الدور</h4>
                            <p class="text-sm text-gray-600">هل تريد تفعيل هذا الدور فور الإنشاء؟</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
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
                    حفظ الدور
                </button>
            </div>
        </form>
    </div>

    {{-- Quick Tips --}}
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-3xl p-6">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-lightbulb text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-blue-900 mb-2">نصائح مهمة</h3>
                <ul class="text-blue-800 text-sm space-y-1">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-blue-600 mt-0.5 flex-shrink-0"></i>
                        <span>استخدم أسماء واضحة ومفهومة للأدوار</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-blue-600 mt-0.5 flex-shrink-0"></i>
                        <span>تجنب استخدام أسماء الأدوار المحجوزة مثل "root" أو "system"</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-blue-600 mt-0.5 flex-shrink-0"></i>
                        <span>يمكنك تعديل صلاحيات الدور لاحقاً من خلال صفحة التعديل</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-suggest role names
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