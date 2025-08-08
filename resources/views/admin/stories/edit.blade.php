@extends('layouts.dashboard')

@section('page-title', 'تعديل قصة')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تعديل قصة #{{ $story->id }}</h1>
                <p class="text-gray-600 mt-2">تعديل معلومات قصة المستفيد</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.stories.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">قصص المستفيدين</a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تعديل قصة</span>
                </nav>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.stories.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    {{-- Current Story Info --}}
    <div class="bg-blue-50 border border-blue-200 rounded-3xl p-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-book text-white"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-blue-900 mb-2">معلومات القصة الحالية</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-blue-700 font-medium">العنوان:</span>
                        <p class="text-blue-900">{{ $story->title }}</p>
                    </div>
                    <div>
                        <span class="text-blue-700 font-medium">المستفيد:</span>
                        <p class="text-blue-900">{{ $story->beneficiary->name ?? 'غير محدد' }}</p>
                    </div>
                    <div>
                        <span class="text-blue-700 font-medium">الحالة:</span>
                        @if($story->status === 'published')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                منشورة
                            </span>
                        @elseif($story->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                معلقة
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-pencil-alt {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                مسودة
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.stories.update', $story->id) }}" method="POST" enctype="multipart/form-data" class="p-6 lg:p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Form Header --}}
            <div class="border-b border-gray-200 pb-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-book text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">تعديل معلومات القصة</h2>
                        <p class="text-gray-600 text-sm">قم بتحديث معلومات القصة</p>
                    </div>
                </div>
            </div>

            {{-- Form Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-heading text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        العنوان <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" required
                           value="{{ old('title', $story->title) }}"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('title') border-red-500 @enderror"
                           placeholder="أدخل عنوان القصة">
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Beneficiary --}}
                <div>
                    <label for="beneficiary_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        المستفيد <span class="text-red-500">*</span>
                    </label>
                    <select id="beneficiary_id" name="beneficiary_id" required
                            class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('beneficiary_id') border-red-500 @enderror">
                        <option value="">اختر المستفيد</option>
                        @foreach($beneficiaries as $beneficiary)
                            <option value="{{ $beneficiary->id }}" {{ old('beneficiary_id', $story->beneficiary_id) == $beneficiary->id ? 'selected' : '' }}>
                                {{ $beneficiary->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('beneficiary_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-image text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        الصورة
                    </label>
                    @if($story->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $story->image) }}" alt="{{ $story->title }}" class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    @endif
                    <input type="file" id="image" name="image" accept="image/*"
                           class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-info-circle text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        الحالة <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                            class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('status') border-red-500 @enderror">
                        <option value="draft" {{ old('status', $story->status) === 'draft' ? 'selected' : '' }}>مسودة</option>
                        <option value="pending" {{ old('status', $story->status) === 'pending' ? 'selected' : '' }}>معلقة</option>
                        <option value="published" {{ old('status', $story->status) === 'published' ? 'selected' : '' }}>منشورة</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="md:col-span-2">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left text-indigo-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        المحتوى <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content" rows="8" required
                              class="block w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 @error('content') border-red-500 @enderror"
                              placeholder="اكتب محتوى القصة هنا...">{{ old('content', $story->content) }}</textarea>
                    @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-between gap-4 pt-6 border-t border-gray-200">
                <div>
                    <form action="{{ route('admin.stories.destroy', $story->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('هل أنت متأكد من حذف هذه القصة؟')">
                            <i class="fas fa-trash {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            حذف القصة
                        </button>
                    </form>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.stories.index') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        إلغاء
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg hover:shadow-xl">
                        <i class="fas fa-save {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        حفظ التعديلات
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
