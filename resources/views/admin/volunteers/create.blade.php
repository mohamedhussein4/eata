@extends('layouts.dashboard')

@section('page-title', 'إضافة متطوع جديد')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">إضافة متطوع جديد</h1>
                <p class="text-gray-600 mt-2">إنشاء حساب متطوع جديد في النظام</p>

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
                    <span class="text-gray-700 font-medium">إضافة جديد</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.volunteers.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Create Volunteer Form --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.volunteers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="p-6 lg:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Basic Information --}}
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-user text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                المعلومات الأساسية
                            </h3>
                        </div>

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                الاسم الكامل <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" required
                                   value="{{ old('name') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('name') border-red-500 @enderror"
                                   placeholder="أدخل الاسم الكامل">
                            @error('name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                البريد الإلكتروني <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required
                                   value="{{ old('email') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('email') border-red-500 @enderror"
                                   placeholder="أدخل البريد الإلكتروني">
                            @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                رقم الهاتف <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="phone" name="phone" required
                                   value="{{ old('phone') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('phone') border-red-500 @enderror"
                                   placeholder="أدخل رقم الهاتف">
                            @error('phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Age --}}
                        <div>
                            <label for="age" class="block text-sm font-medium text-gray-700 mb-2">
                                العمر <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="age" name="age" required min="18"
                                   value="{{ old('age') }}"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('age') border-red-500 @enderror"
                                   placeholder="أدخل العمر">
                            @error('age')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                العنوان <span class="text-red-500">*</span>
                            </label>
                            <textarea id="address" name="address" rows="3" required
                                      class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 resize-none @error('address') border-red-500 @enderror"
                                      placeholder="أدخل العنوان">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Volunteer Details --}}
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-heart text-red-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                تفاصيل التطوع
                            </h3>
                        </div>

                        {{-- Skills --}}
                        <div>
                            <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">
                                المهارات
                            </label>
                            <textarea id="skills" name="skills" rows="3"
                                      class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 resize-none @error('skills') border-red-500 @enderror"
                                      placeholder="أدخل المهارات والخبرات">{{ old('skills') }}</textarea>
                            @error('skills')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Experience --}}
                        <div>
                            <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">
                                الخبرة السابقة
                            </label>
                            <textarea id="experience" name="experience" rows="3"
                                      class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 resize-none @error('experience') border-red-500 @enderror"
                                      placeholder="أدخل الخبرة السابقة في التطوع">{{ old('experience') }}</textarea>
                            @error('experience')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Motivation --}}
                        <div>
                            <label for="motivation" class="block text-sm font-medium text-gray-700 mb-2">
                                الدافع للتطوع
                            </label>
                            <textarea id="motivation" name="motivation" rows="3"
                                      class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 resize-none @error('motivation') border-red-500 @enderror"
                                      placeholder="أدخل الدافع للتطوع">{{ old('motivation') }}</textarea>
                            @error('motivation')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- CV Upload --}}
                        <div>
                            <label for="cv" class="block text-sm font-medium text-gray-700 mb-2">
                                السيرة الذاتية
                            </label>
                            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('cv') border-red-500 @enderror">
                            @error('cv')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-sm mt-1">أنواع الملفات المسموحة: PDF, DOC, DOCX. الحد الأقصى: 2MB</p>
                        </div>

                        {{-- Approval Status --}}
                        <div>
                            <label for="is_approved" class="flex items-center">
                                <input type="checkbox" id="is_approved" name="is_approved" value="1" 
                                       {{ old('is_approved') ? 'checked' : '' }}
                                       class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700 {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }}">موافقة فورية</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-info-circle {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    تأكد من صحة البيانات قبل الحفظ
                </div>
                <div class="flex items-center gap-3">
                    <button type="reset" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-undo {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        إعادة تعيين
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        إنشاء المتطوع
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 