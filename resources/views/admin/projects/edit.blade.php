@extends('layouts.dashboard')

@section('page-title', 'تعديل المشروع')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تعديل المشروع</h1>
                <p class="text-gray-600 mt-2">تعديل مشروع: {{ $project->title }}</p>
                
                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.projects.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">المشاريع</a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تعديل المشروع</span>
                </nav>
            </div>
            
            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Current Project Info --}}
    <div class="bg-blue-50 border border-blue-200 rounded-3xl p-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-project-diagram text-white"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-blue-900 mb-2">معلومات المشروع الحالية</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-blue-700 font-medium">العنوان:</span>
                        <p class="text-blue-900">{{ $project->title }}</p>
                    </div>
                    <div>
                        <span class="text-blue-700 font-medium">المبلغ المستهدف:</span>
                        <p class="text-blue-900">{{ number_format($project->total_amount ?? $project->target_amount ?? 0) }} ل.س</p>
                    </div>
                    <div>
                        <span class="text-blue-700 font-medium">عدد الزيارات:</span>
                        <p class="text-blue-900">{{ $project->visits ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Section --}}
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Hidden Fields --}}
        <input type="hidden" name="visits" value="{{ $project->visits ?? 0 }}">
        <input type="hidden" name="donation_count" value="{{ $project->donation_count ?? 0 }}">
        <input type="hidden" name="beneficiaries_count" value="{{ $project->beneficiaries_count ?? 0 }}">

        {{-- Basic Information Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 border-b border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-info-circle text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">المعلومات الأساسية</h2>
                        <p class="text-gray-600 text-sm">تعديل المعلومات الأساسية للمشروع</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 lg:p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Project Title --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            عنوان المشروع <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" required
                               value="{{ old('title', $project->title) }}"
                               class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('title') border-red-500 @enderror"
                               placeholder="أدخل عنوان المشروع">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Target Amount --}}
                    <div>
                        <label for="target_amount" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-target text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            المبلغ المستهدف <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" id="target_amount" name="target_amount" required min="0" step="0.01"
                                   value="{{ old('target_amount', $project->total_amount ?? $project->target_amount ?? 0) }}"
                                   class="block w-full px-4 py-3 {{ app()->getLocale() === 'ar' ? 'pl-12' : 'pr-12' }} border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('target_amount') border-red-500 @enderror"
                                   placeholder="0">
                            <div class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">ل.س</span>
                            </div>
                        </div>
                        @error('target_amount')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Project Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-file-alt text-purple-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        وصف المشروع <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description" name="description" rows="6" required
                              class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 resize-none @error('description') border-red-500 @enderror"
                              placeholder="أدخل وصف تفصيلي للمشروع...">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Project Category --}}
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tags text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        فئة المشروع
                    </label>
                    <select id="category" name="category"
                            class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('category') border-red-500 @enderror">
                        <option value="">اختر فئة المشروع</option>
                        <option value="health" {{ old('category', $project->category) === 'health' ? 'selected' : '' }}>الصحة</option>
                        <option value="education" {{ old('category', $project->category) === 'education' ? 'selected' : '' }}>التعليم</option>
                        <option value="food" {{ old('category', $project->category) === 'food' ? 'selected' : '' }}>الغذاء</option>
                        <option value="housing" {{ old('category', $project->category) === 'housing' ? 'selected' : '' }}>الإسكان</option>
                        <option value="emergency" {{ old('category', $project->category) === 'emergency' ? 'selected' : '' }}>الطوارئ</option>
                        <option value="other" {{ old('category', $project->category) === 'other' ? 'selected' : '' }}>أخرى</option>
                    </select>
                    @error('category')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Media & Additional Info Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 border-b border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-image text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">الوسائط والمعلومات الإضافية</h2>
                        <p class="text-gray-600 text-sm">صورة المشروع ومعلومات إضافية</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 lg:p-8 space-y-6">
                {{-- Project Image/Video --}}
                <div>
                    <label for="image_or_video" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-camera text-pink-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        صورة أو فيديو المشروع
                    </label>
                    
                    @if($project->image_or_video)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">الملف الحالي:</p>
                        <div class="relative">
                            @if(in_array(pathinfo($project->image_or_video, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset('storage/images/' . $project->image_or_video) }}" 
                                     alt="{{ $project->title }}" 
                                     class="w-full h-48 object-cover rounded-2xl border border-gray-200">
                            @else
                                <div class="w-full h-48 bg-gray-100 rounded-2xl border border-gray-200 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-file text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-600 text-sm">{{ $project->image_or_video }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <div class="flex items-center justify-center w-full">
                        <label for="image_or_video" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">
                                    <span class="font-semibold">اضغط للرفع</span> أو اسحب الملف
                                </p>
                                <p class="text-xs text-gray-500">صورة أو فيديو (بحد أقصى 20MB)</p>
                            </div>
                            <input id="image_or_video" name="image_or_video" type="file" class="hidden" accept="image/*,video/*">
                        </label>
                    </div>
                    @error('image_or_video')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Additional Statistics --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 rounded-2xl p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-eye text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            عدد الزيارات
                        </label>
                        <div class="text-2xl font-bold text-blue-600">{{ number_format($project->visits ?? 0) }}</div>
                        <p class="text-xs text-gray-500 mt-1">إجمالي المشاهدات</p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-hand-holding-heart text-green-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            عدد التبرعات
                        </label>
                        <div class="text-2xl font-bold text-green-600">{{ number_format($project->donation_count ?? 0) }}</div>
                        <p class="text-xs text-gray-500 mt-1">إجمالي المتبرعين</p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-users text-purple-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            عدد المستفيدين
                        </label>
                        <div class="text-2xl font-bold text-purple-600">{{ number_format($project->beneficiaries_count ?? 0) }}</div>
                        <p class="text-xs text-gray-500 mt-1">المستفيدين المتوقعين</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-4 bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <a href="{{ route('admin.projects.index') }}" 
               class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                إلغاء
            </a>
            <button type="submit" 
                    class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg hover:shadow-xl">
                <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                حفظ التعديلات
            </button>
        </div>
    </form>

    {{-- Delete Section --}}
    <div class="bg-red-50 border border-red-200 rounded-3xl p-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-red-900 mb-2">منطقة خطر</h3>
                <p class="text-red-700 text-sm mb-4">حذف المشروع عملية غير قابلة للتراجع. سيتم حذف جميع البيانات والتبرعات المرتبطة به نهائياً.</p>
                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('هل أنت متأكد من حذف هذا المشروع؟ هذا الإجراء لا يمكن التراجع عنه!')"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        حذف المشروع نهائياً
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview uploaded file
    const fileInput = document.getElementById('image_or_video');
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            console.log('File selected:', file.name);
            // يمكن إضافة معاينة هنا
        }
    });

    // Format numbers in statistics
    const numberElements = document.querySelectorAll('[data-number]');
    numberElements.forEach(el => {
        const number = parseInt(el.textContent);
        el.textContent = number.toLocaleString('ar-EG');
    });
});
</script>
@endsection