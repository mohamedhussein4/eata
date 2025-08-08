@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="inline-block px-6 py-2 text-sm font-medium text-charity-600 bg-charity-100 rounded-full mb-4">
            {{ app()->getLocale() === 'ar' ? '🔔 الإشعارات' : '🔔 Notifications' }}
        </span>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 font-{{ app()->getLocale() === 'ar' ? 'arabic' : 'english' }}">
            {{ app()->getLocale() === 'ar' ? 'إشعاراتك' : 'Your Notifications' }}
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            {{ app()->getLocale() === 'ar' ? 'تابع آخر التحديثات والأنشطة المتعلقة بحسابك' : 'Keep track of the latest updates and activities related to your account' }}
        </p>
    </div>

    <!-- Notifications List -->
    <div class="max-w-4xl mx-auto">
        @if($notifications->count() > 0)
            <!-- Mark All as Read Button -->
            @if($notifications->where('is_read', false)->count() > 0)
                <div class="mb-6 text-right">
                    <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-check-double {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ app()->getLocale() === 'ar' ? 'تحديد الكل كمقروء' : 'Mark All as Read' }}
                        </button>
                    </form>
                </div>
            @endif

            <div class="space-y-4">
                @foreach($notifications as $notification)
                    <div class="flex items-start gap-4 p-6 {{ $notification->is_read ? 'bg-white' : 'bg-emerald-50' }} rounded-2xl hover:bg-emerald-50/80 transition-all duration-300 group shadow-sm hover:shadow-md border border-gray-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:from-emerald-200 group-hover:to-teal-200">
                            @switch($notification->type)
                                @case('donation')
                                    <i class="fas fa-hand-holding-heart text-emerald-600 text-xl"></i>
                                    @break
                                @case('project')
                                    <i class="fas fa-project-diagram text-emerald-600 text-xl"></i>
                                    @break
                                @case('volunteer')
                                    <i class="fas fa-hands-helping text-emerald-600 text-xl"></i>
                                    @break
                                @default
                                    <i class="fas fa-bell text-emerald-600 text-xl"></i>
                            @endswitch
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 text-lg group-hover:text-emerald-600">
                                {{ $notification->title }}
                            </h4>
                            <p class="text-gray-600 mt-2">
                                {{ $notification->message }}
                            </p>
                            <div class="flex items-center justify-between mt-4">
                                <p class="text-gray-400 text-sm">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                                @if(!$notification->is_read)
                                    <form action="{{ route('notifications.mark-read', $notification->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                                            {{ app()->getLocale() === 'ar' ? 'تحديد كمقروء' : 'Mark as Read' }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($notifications->hasPages())
                <div class="mt-8">
                    {{ $notifications->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bell-slash text-2xl text-gray-400"></i>
                </div>
                <h4 class="text-xl font-semibold text-gray-900 mb-2">
                    {{ app()->getLocale() === 'ar' ? 'لا توجد إشعارات' : 'No Notifications' }}
                </h4>
                <p class="text-gray-600">
                    {{ app()->getLocale() === 'ar' ? 'سنعلمك عند وصول إشعارات جديدة' : 'We\'ll notify you when new notifications arrive' }}
                </p>
            </div>
        @endif
    </div>
</div>
@endsection 