@extends('layouts.dashboard')

@section('page-title', 'تفاصيل التذكرة')

@section('content')
<div class="space-y-6">
    {{-- Page Header --}}
    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">تفاصيل التذكرة #{{ $ticket->id }}</h1>
                <p class="text-gray-600 mt-2">{{ $ticket->subject }}</p>

                {{-- Breadcrumbs --}}
                <nav class="flex items-center space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.support.tickets.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        التذاكر
                    </a>
                    <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 text-xs"></i>
                    <span class="text-gray-700 font-medium">تفاصيل التذكرة</span>
                </nav>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                @if($ticket->status !== 'closed')
                    <form action="{{ route('admin.support.tickets.close', $ticket->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-2xl transition-all duration-300"
                                onclick="return confirm('هل أنت متأكد من إغلاق هذه التذكرة؟')">
                            <i class="fas fa-times {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            إغلاق التذكرة
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.support.tickets.reopen', $ticket->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-2xl transition-all duration-300">
                            <i class="fas fa-redo {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            إعادة فتح التذكرة
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Chat Messages --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Messages List --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">المحادثة</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($ticket->messages as $message)
                        <div class="p-6 {{ $message->sender_id === auth()->id() ? 'bg-indigo-50' : '' }}">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 {{ $message->sender_id === auth()->id() ? 'bg-indigo-100' : 'bg-gray-100' }} rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user {{ $message->sender_id === auth()->id() ? 'text-indigo-600' : 'text-gray-600' }}"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium {{ $message->sender_id === auth()->id() ? 'text-indigo-900' : 'text-gray-900' }}">
                                            {{ $message->sender->name }}
                                            @if($message->sender->type === 'admin')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }}">
                                                    مدير النظام
                                                </span>
                                            @endif
                                        </p>
                                        <span class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="mt-1 text-sm text-gray-700 whitespace-pre-wrap">{{ $message->message }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Reply Form --}}
            @if($ticket->status !== 'closed')
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <form action="{{ route('admin.support.tickets.reply', $ticket->id) }}" method="POST" class="p-6">
                        @csrf
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">الرد</label>
                            <textarea id="content" 
                                    name="content" 
                                    rows="4" 
                                    required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                    placeholder="اكتب ردك هنا..."></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl transition-all duration-300">
                                <i class="fas fa-paper-plane {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                إرسال الرد
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>

        {{-- Ticket Details --}}
        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">تفاصيل التذكرة</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">الحالة</h3>
                        @php
                            $statusColors = [
                                'open' => 'bg-green-100 text-green-800',
                                'closed' => 'bg-red-100 text-red-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                            ];
                            $statusLabels = [
                                'open' => 'مفتوحة',
                                'closed' => 'مغلقة',
                                'pending' => 'في الانتظار',
                            ];
                        @endphp
                        <p class="mt-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColors[$ticket->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $statusLabels[$ticket->status] ?? $ticket->status }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">تاريخ الإنشاء</h3>
                        <p class="mt-2 text-sm text-gray-900">{{ $ticket->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">آخر تحديث</h3>
                        <p class="mt-2 text-sm text-gray-900">{{ $ticket->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">المستخدم</h3>
                        <div class="mt-2 flex items-center">
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-gray-600"></i>
                            </div>
                            <div class="{{ app()->getLocale() === 'ar' ? 'mr-3' : 'ml-3' }}">
                                <p class="text-sm font-medium text-gray-900">{{ $ticket->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $ticket->user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 