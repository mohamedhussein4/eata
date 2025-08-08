@php
    $ticket = App\Models\Ticket::where('user_id', auth()->id())->first();
    $messages = $ticket ? App\Models\Message::where('ticket_id', $ticket->id)->get() : collect();
@endphp

<!-- نظام الشات الجديد -->
<div id="chat-system" class="fixed bottom-6 {{ app()->getLocale() === 'ar' ? 'left-6' : 'right-6' }} z-50">
    <!-- زر فتح الشات -->
    <div id="chat-toggle" class="relative">
        <button onclick="toggleChat()" class="w-16 h-16 bg-gradient-to-r from-charity-500 to-charity-600 hover:from-charity-600 hover:to-charity-700 text-white rounded-full shadow-2xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 animate-pulse">
            <i class="fas fa-comments text-xl" id="chat-icon"></i>
            <!-- مؤشر الرسائل الجديدة -->
            @if($messages->count() > 0)
            <span class="absolute -top-2 -{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}-2 bg-red-500 text-white text-xs rounded-full h-6 w-6 flex items-center justify-center animate-bounce">
                {{ $messages->count() > 9 ? '9+' : $messages->count() }}
            </span>
            @endif
        </button>

        <!-- تلميح -->
        <div class="absolute bottom-full {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mb-2 bg-gray-900 text-white text-sm py-2 px-3 rounded-lg opacity-0 invisible transition-all duration-200" id="chat-tooltip">
            {{ app()->getLocale() === 'ar' ? 'تحدث معنا' : 'Chat with us' }}
            <div class="absolute top-full {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }} w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
        </div>
    </div>

    <!-- نافذة الشات -->
    <div id="chat-window" class="hidden absolute bottom-20 {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden transform transition-all duration-300 opacity-0 scale-95">
        <!-- رأس الشات -->
        <div class="bg-gradient-to-r from-charity-500 to-charity-600 p-4 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold">{{ app()->getLocale() === 'ar' ? 'الدعم الفني' : 'Customer Support' }}</h3>
                        <p class="text-xs text-white/80">{{ app()->getLocale() === 'ar' ? 'نحن هنا للمساعدة' : 'We\'re here to help' }}</p>
                    </div>
                </div>
                <button onclick="toggleChat()" class="text-white/80 hover:text-white transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>

        <!-- منطقة الرسائل -->
        <div id="messages-container" class="h-80 overflow-y-auto p-4 space-y-4 bg-gray-50">
            @if($messages->isEmpty())
                <!-- رسالة الترحيب -->
                <div class="flex items-start space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                    <div class="w-8 h-8 bg-charity-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-robot text-white text-sm"></i>
                    </div>
                    <div class="bg-white rounded-2xl rounded-{{ app()->getLocale() === 'ar' ? 'br' : 'bl' }}-md p-3 shadow-sm max-w-xs">
                        <p class="text-sm text-gray-800">
                            {{ app()->getLocale() === 'ar' ? 'مرحباً! كيف يمكنني مساعدتك اليوم؟' : 'Hello! How can I help you today?' }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">{{ now()->format('H:i') }}</p>
                    </div>
                </div>
            @else
                @foreach($messages as $message)
                    @if($message->sender_id == auth()->id())
                        <!-- رسالة المستخدم -->
                        <div class="flex items-start justify-end space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                            <div class="bg-charity-500 text-white rounded-2xl rounded-{{ app()->getLocale() === 'ar' ? 'bl' : 'br' }}-md p-3 shadow-sm max-w-xs">
                                <p class="text-sm">{{ $message->message }}</p>
                                <p class="text-xs text-charity-100 mt-1">{{ $message->created_at->format('H:i') }}</p>
                            </div>
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                        </div>
                    @else
                        <!-- رسالة الدعم -->
                        <div class="flex items-start space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                            <div class="w-8 h-8 bg-charity-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-headset text-white text-sm"></i>
                            </div>
                            <div class="bg-white rounded-2xl rounded-{{ app()->getLocale() === 'ar' ? 'br' : 'bl' }}-md p-3 shadow-sm max-w-xs">
                                <p class="text-sm text-gray-800">{{ $message->message }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $message->created_at->format('H:i') }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

            <!-- مؤشر الكتابة -->
            <div id="typing-indicator" class="hidden flex items-start space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                <div class="w-8 h-8 bg-charity-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-headset text-white text-sm"></i>
                </div>
                <div class="bg-white rounded-2xl rounded-{{ app()->getLocale() === 'ar' ? 'br' : 'bl' }}-md p-3 shadow-sm">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce animation-delay-200"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce animation-delay-400"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- منطقة الكتابة -->
        <div class="p-4 border-t border-gray-200 bg-white">
            <form id="message-form" onsubmit="sendMessage(event)" class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                @csrf
                <div class="flex-1 relative">
                    <input type="text"
                           id="message-input"
                           name="message"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'اكتب رسالتك...' : 'Type your message...' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-charity-500 focus:border-transparent transition-all duration-200"
                           maxlength="500"
                           required>
                    <button type="button" onclick="toggleEmojiPicker()" class="absolute {{ app()->getLocale() === 'ar' ? 'left-3' : 'right-3' }} top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-smile"></i>
                    </button>
                </div>
                <button type="submit"
                        class="w-10 h-10 bg-charity-500 hover:bg-charity-600 text-white rounded-full flex items-center justify-center transition-all duration-200 transform hover:scale-110"
                        id="send-button">
                    <i class="fas fa-paper-plane text-sm"></i>
                </button>
            </form>

            <!-- أزرار سريعة -->
            <div class="flex flex-wrap gap-2 mt-3" id="quick-replies">
                <button onclick="insertQuickReply('{{ app()->getLocale() === 'ar' ? 'أحتاج مساعدة في التبرع' : 'I need help with donation' }}')" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
                    {{ app()->getLocale() === 'ar' ? 'مساعدة في التبرع' : 'Donation Help' }}
                </button>
                <button onclick="insertQuickReply('{{ app()->getLocale() === 'ar' ? 'كيف يمكنني التطوع؟' : 'How can I volunteer?' }}')" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
                    {{ app()->getLocale() === 'ar' ? 'التطوع' : 'Volunteer' }}
                </button>
                <button onclick="insertQuickReply('{{ app()->getLocale() === 'ar' ? 'معلومات عن المشاريع' : 'Project information' }}')" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
                    {{ app()->getLocale() === 'ar' ? 'المشاريع' : 'Projects' }}
                </button>
            </div>
        </div>

        <!-- تذييل الشات -->
        <div class="px-4 py-2 bg-gray-50 border-t border-gray-200">
            <p class="text-xs text-gray-500 text-center flex items-center justify-center">
                <i class="fas fa-shield-alt {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                {{ app()->getLocale() === 'ar' ? 'محادثة آمنة ومشفرة' : 'Secure & encrypted chat' }}
            </p>
        </div>
    </div>
</div>

<script>
let chatOpen = false;
let typingTimeout;

// تبديل حالة الشات
function toggleChat() {
    const chatWindow = document.getElementById('chat-window');
    const chatIcon = document.getElementById('chat-icon');
    const chatTooltip = document.getElementById('chat-tooltip');
    const backToTopButton = document.getElementById('back-to-top');

    chatOpen = !chatOpen;

    if (chatOpen) {
        chatWindow.classList.remove('hidden');
        setTimeout(() => {
            chatWindow.classList.remove('opacity-0', 'scale-95');
            chatWindow.classList.add('opacity-100', 'scale-100');
        }, 10);
        chatIcon.className = 'fas fa-times text-xl';
        chatTooltip.classList.add('opacity-0', 'invisible');

        // تحريك زر العودة للأعلى لأعلى عند فتح الشات
        if (backToTopButton) {
            backToTopButton.classList.remove('bottom-28');
            backToTopButton.classList.add('bottom-[28rem]');
        }

        // التركيز على حقل الإدخال
        setTimeout(() => {
            document.getElementById('message-input').focus();
        }, 300);
    } else {
        chatWindow.classList.add('opacity-0', 'scale-95');
        chatWindow.classList.remove('opacity-100', 'scale-100');
        setTimeout(() => {
            chatWindow.classList.add('hidden');
        }, 300);
        chatIcon.className = 'fas fa-comments text-xl';

        // إعادة زر العودة للأعلى لموضعه الأصلي
        if (backToTopButton) {
            backToTopButton.classList.remove('bottom-[28rem]');
            backToTopButton.classList.add('bottom-28');
        }
    }
}

// إرسال رسالة
function sendMessage(event) {
    event.preventDefault();

    const messageInput = document.getElementById('message-input');
    const message = messageInput.value.trim();

    if (!message) return;

    // إضافة الرسالة للواجهة
    addMessageToUI(message, 'user');
    messageInput.value = '';

    // إظهار مؤشر الكتابة
    showTypingIndicator();

    // إرسال الرسالة للخادم
    fetch("{{ route('tickets.store') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            subject: "{{ app()->getLocale() === 'ar' ? 'استفسار من الشات' : 'Chat Inquiry' }}",
            message: message
        })
    })
    .then(response => response.json())
    .then(data => {
        hideTypingIndicator();
        if (data.success) {
            // يمكن إضافة رد تلقائي هنا
            setTimeout(() => {
                addMessageToUI("{{ app()->getLocale() === 'ar' ? 'شكراً لتواصلك معنا. سيتم الرد عليك قريباً.' : 'Thank you for contacting us. We will respond soon.' }}", 'support');
            }, 1000);
        }
    })
    .catch(error => {
        hideTypingIndicator();
        console.error('Error:', error);
        showToast("{{ app()->getLocale() === 'ar' ? 'حدث خطأ في إرسال الرسالة' : 'Error sending message' }}", 'error');
    });
}

// إضافة رسالة للواجهة
function addMessageToUI(message, sender) {
    const messagesContainer = document.getElementById('messages-container');
    const messageDiv = document.createElement('div');
    const currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

    if (sender === 'user') {
        messageDiv.className = 'flex items-start justify-end space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}';
        messageDiv.innerHTML = `
            <div class="bg-charity-500 text-white rounded-2xl rounded-{{ app()->getLocale() === 'ar' ? 'bl' : 'br' }}-md p-3 shadow-sm max-w-xs">
                <p class="text-sm">${message}</p>
                <p class="text-xs text-charity-100 mt-1">${currentTime}</p>
            </div>
            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
        `;
    } else {
        messageDiv.className = 'flex items-start space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}';
        messageDiv.innerHTML = `
            <div class="w-8 h-8 bg-charity-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-headset text-white text-sm"></i>
            </div>
            <div class="bg-white rounded-2xl rounded-{{ app()->getLocale() === 'ar' ? 'br' : 'bl' }}-md p-3 shadow-sm max-w-xs">
                <p class="text-sm text-gray-800">${message}</p>
                <p class="text-xs text-gray-500 mt-1">${currentTime}</p>
            </div>
        `;
    }

    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// إظهار مؤشر الكتابة
function showTypingIndicator() {
    const typingIndicator = document.getElementById('typing-indicator');
    typingIndicator.classList.remove('hidden');
    const messagesContainer = document.getElementById('messages-container');
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// إخفاء مؤشر الكتابة
function hideTypingIndicator() {
    const typingIndicator = document.getElementById('typing-indicator');
    typingIndicator.classList.add('hidden');
}

// إدراج رد سريع
function insertQuickReply(text) {
    const messageInput = document.getElementById('message-input');
    messageInput.value = text;
    messageInput.focus();
}

// تلميح الشات
document.getElementById('chat-toggle').addEventListener('mouseenter', () => {
    if (!chatOpen) {
        const tooltip = document.getElementById('chat-tooltip');
        tooltip.classList.remove('opacity-0', 'invisible');
        tooltip.classList.add('opacity-100', 'visible');
    }
});

document.getElementById('chat-toggle').addEventListener('mouseleave', () => {
    const tooltip = document.getElementById('chat-tooltip');
    tooltip.classList.add('opacity-0', 'invisible');
    tooltip.classList.remove('opacity-100', 'visible');
});

// إغلاق الشات عند الضغط خارجه
document.addEventListener('click', (event) => {
    const chatSystem = document.getElementById('chat-system');
    if (chatOpen && !chatSystem.contains(event.target)) {
        toggleChat();
    }
});

// منع إغلاق الشات عند الضغط داخله
document.getElementById('chat-system').addEventListener('click', (event) => {
    event.stopPropagation();
});

// تحديث تلقائي للرسائل (اختياري)
setInterval(() => {
    if (chatOpen) {
        // يمكن إضافة منطق تحديث الرسائل هنا
    }
}, 30000); // كل 30 ثانية
</script>
