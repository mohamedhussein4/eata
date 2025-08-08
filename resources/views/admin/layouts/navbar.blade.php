<nav class="navbar navbar-expand-lg custom-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#WafiAdminNavbar"
        aria-controls="WafiAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i></i>
            <i></i>
            <i></i>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="WafiAdminNavbar">
        <ul class="navbar-nav">
            <!-- لوحة التحكم الرئيسية -->
            <li class="nav-item dropdown">
                <a class="nav-link {{ Request::is('dashboard/index') ? 'active-page' : '' }}"
                    href="{{ route('admin.index') }}">
                    <i class="icon-devices_other nav-icon"></i>
                    لوحة التحكم
                </a>
            </li>

            <!-- إدارة المشاريع -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('dashboard/projects*') ? 'active-page' : '' }}"
                    href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="icon-package nav-icon"></i>
                    المشاريع
                </a>
                <ul class="dropdown-menu" aria-labelledby="appsDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.projects.index') }}">عرض المشاريع</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.projects.create') }}">اضافة مشروع جديد</a>
                    </li>
                </ul>
            </li>

            <!-- القسم المالي -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle
                    {{ Request::is('dashboard/bank-accounts*') ? 'active-page' : '' }}
                    {{ Request::is('dashboard/e-wallets*') ? 'active-page' : '' }}"
                    href="#" id="financialDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-hand-holding-usd nav-icon"></i>
                    الإدارة المالية
                </a>
                <ul class="dropdown-menu" aria-labelledby="financialDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.bank-accounts.index') }}">الحسابات البنكية</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.bank-accounts.create') }}">اضافة حساب بنكي</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.e-wallets.index') }}">المحافظ الإلكترونية</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.e-wallets.create') }}">اضافة محفظة إلكترونية</a>
                    </li>
                </ul>
            </li>

            <!-- إدارة المستخدمين -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('dashboard/users*') ? 'active-page' : '' }}"
                    href="#" id="usersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="icon-users nav-icon"></i>
                    المستخدمين
                </a>
                <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.users.index') }}">عرض المستخدمين</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('roles.index') }}">الادوار</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('roles.create') }}">اضافة دور</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.users.create') }}">اضافة مسؤوليين</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.users.volunteer') }}">عرض المتطوعين</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.users.beneficiary') }}">عرض المستفيدين</a>
                    </li>
                </ul>
            </li>

            <!-- نظام التبرعات -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle
                    {{ Request::is('dashboard/orders*') ? 'active-page' : '' }}
                    {{ Request::is('dashboard/donations*') ? 'active-page' : '' }}
                    {{ Request::is('dashboard/food-donations*') ? 'active-page' : '' }}
                    {{ Request::is('dashboard/digital-currency-donations*') ? 'active-page' : '' }}
                    {{ Request::is('dashboard/sms-donation*') ? 'active-page' : '' }}"
                    href="#" id="donationsDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-donate nav-icon"></i>
                    التبرعات
                </a>
                <ul class="dropdown-menu" aria-labelledby="donationsDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.orders.index') }}">طلبات التبرعات</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.donations.index') }}">التبرعات السريعة</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.food-donations.index') }}">تبرعات الأغذية</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.digital_currency_donations.index') }}">تبرعات العملات الرقمية</a>
                    </li>

                    <!-- تبرعات الرسائل النصية -->
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.sms_donations.index') }}">أنواع رسائل التبرع</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.sms_donation_records.index') }}">سجلات رسائل التبرع</a>
                    </li>
                </ul>
            </li>

            <!-- قصص المستفيدين -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stories*') ? 'active-page' : '' }}"
                    href="#" id="storiesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-book-open nav-icon"></i>
                    قصص المستفيدين
                </a>
                <ul class="dropdown-menu" aria-labelledby="storiesDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.dashboard.stories.index') }}">كل القصص</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.dashboard.stories.pending') }}">
                            القصص المعلقة
                            <span class="badge badge-warning">{{ \App\Models\BeneficiaryStory::where('is_approved', false)->count() }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.stories.index') }}" target="_blank">عرض في الموقع</a>
                    </li>
                </ul>
            </li>

            <!-- آراء المستخدمين -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('dashboard/testimonials*') ? 'active-page' : '' }}"
                    href="#" id="testimonialsDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-star nav-icon"></i>
                    آراء المستخدمين
                </a>
                <ul class="dropdown-menu" aria-labelledby="testimonialsDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.dashboard.testimonials.index') }}">كل الآراء</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.dashboard.testimonials.pending') }}">
                            الآراء المعلقة
                            <span class="badge badge-warning">{{ \App\Models\Testimonial::where('is_approved', false)->count() }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.dashboard.testimonials.create') }}">إضافة رأي جديد</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.testimonials.index') }}" target="_blank">عرض في الموقع</a>
                    </li>
                </ul>
            </li>

            <!-- طلبات المستخدمين -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle
                    {{ Request::is('dashboard/volunteers*') ? 'active-page' : '' }}
                    {{ Request::is('dashboard/beneficiaries*') ? 'active-page' : '' }}
                    {{ Request::is('dashboard/tickets*') ? 'active-page' : '' }}
                    {{ Request::is('dashboard/contacts*') ? 'active-page' : '' }}"
                    href="#" id="requestsDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-tasks nav-icon"></i>
                    الطلبات والدعم
                </a>
                <ul class="dropdown-menu" aria-labelledby="requestsDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('volunteers.dashboard') }}">طلبات المتطوعين</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('beneficiaries.dashboard') }}">طلبات المستفيدين</a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('tickets.index') }}">طلبات المراسلة</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('contacts.index') }}">رسائل الدعم الفني</a>
                    </li>
                </ul>
            </li>

            <!-- إدارة الصفحات -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('dashboard/pages*') ? 'active-page' : '' }}"
                    href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-file-alt nav-icon"></i>
                    إدارة الصفحات
                </a>
                <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.pages.index') }}">عرض الصفحات</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.pages.create') }}">إضافة صفحة جديدة</a>
                    </li>
                </ul>
            </li>

            <!-- الإعدادات -->
            <li class="nav-item dropdown">
                <a class="nav-link {{ Request::is('dashboard/settings') ? 'active-page' : '' }}"
                    href="{{ route('settings.index') }}">
                    <i class="icon-settings nav-icon"></i>
                    الإعدادات
                </a>
            </li>
        </ul>
    </div>
</nav>

<style>
/* أنماط لجعل القائمة متجاوبة مع تمرير عمودي أنيق */
.navbar-wrapper {
    max-height: calc(100vh - 70px);
    overflow-y: auto;
    overflow-x: hidden;
    width: 100%;
    scrollbar-width: thin;
    scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
    direction: ltr; /* لضمان ظهور شريط التمرير على الجانب المناسب */
}

.navbar-wrapper .navbar-nav {
    width: 100%;
    direction: rtl; /* لإرجاع اتجاه النص للقائمة */
}

/* تخصيص شريط التمرير */
.navbar-wrapper::-webkit-scrollbar {
    width: 5px;
}

.navbar-wrapper::-webkit-scrollbar-track {
    background: transparent;
}

.navbar-wrapper::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.2);
    border-radius: 10px;
}

.navbar-wrapper::-webkit-scrollbar-thumb:hover {
    background-color: rgba(0, 0, 0, 0.4);
}

/* حل مشكلة تجاوز العرض في القوائم المنسدلة */
.dropdown-menu {
    max-width: 100%;
    white-space: normal;
    word-wrap: break-word;
}

/* تحسين التجاوب في الشاشات الصغيرة */
@media (max-width: 991.98px) {
    .custom-navbar .navbar-nav {
        padding-right: 0;
    }

    .navbar-collapse {
        max-height: calc(100vh - 70px);
        overflow-y: auto;
    }

    .navbar-nav .dropdown-menu {
        max-width: 100%;
        position: static;
    }
}

/* تخصيص نمط الكتابة لتجنب تجاوز العرض */
.nav-link, .dropdown-item {
    white-space: normal;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
