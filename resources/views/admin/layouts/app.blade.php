<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>Eata - Admin Panel</title>


    <!-- *************
   ************ Common Css Files *************
  ************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/css/bootstrap.min.css">

    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/fonts/style.css">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/css/main.css">


    <!-- *************
   ************ Vendor Css Files *************
  ************ -->
    <!-- DateRange css -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/vendor/daterange/daterange.css" />

    <!-- Chartist css -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/vendor/chartist/css/chartist.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/vendor/chartist/css/chartist-custom.css" />


    <link rel="stylesheet" href="{{ asset('dashboard') }}/vendor/circliful/circliful.css" />

    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/vendor/datatables/dataTables.bs4.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/vendor/datatables/dataTables.bs4-custom.css" />
    <link href="{{ asset('dashboard') }}/vendor/datatables/buttons.bs.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

</head>

<body>

    <!-- Loading starts -->
    <div id="loading-wrapper">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Loading ends -->


    <!-- *************
   ************ Header section start *************
  ************* -->

    <!-- Header start -->
    <header class="header">
        <div class="logo-wrapper">
            <a href="{{ route('admin.index') }}" class="logo">
                <img src="{{ asset('dashboard') }}/img/logo.png" alt="Wafi Admin Dashboard" />
            </a>
            <a href="#" class="quick-links-btn" data-toggle="tooltip" data-placement="right" title=""
                data-original-title="Quick Links">
                <i class="icon-menu1"></i>
            </a>
        </div>
        <div class="header-items">
            <!-- Custom search start -->
            <div class="custom-search">
                <input type="text" class="search-query" placeholder="Search here ...">
                <i class="icon-search1"></i>
            </div>
            <!-- Custom search end -->

            <!-- Header actions start -->
            <ul class="header-actions">
                <li class="dropdown">
                    <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                        <i class="icon-box"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                        <div class="dropdown-menu-header">
                            Tasks (05)
                        </div>
                        <ul class="header-tasks">
                            <li>
                                <p>#48 - Dashboard UI<span>90%</span></p>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="90"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                        <span class="sr-only">90% Complete (success)</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <p>#95 - Alignment Fix<span>60%</span></p>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                        <span class="sr-only">60% Complete (success)</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <p>#7 - Broken Button<span>40%</span></p>
                                <div class="progress">
                                    <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                        <i class="icon-bell"></i>
                        <span class="count-label notifications-count">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                        <div class="dropdown-menu-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    الإشعارات <span class="notifications-count-text">(0)</span>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('admin.notifications.index') }}" class="text-primary small">عرض الكل</a>
                                </div>
                            </div>
                        </div>
                        <ul class="header-notifications notifications-list">
                            <li class="text-center py-2 notifications-loading">
                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="sr-only">جاري التحميل...</span>
                                </div>
                            </li>
                            <li class="text-center py-2 no-notifications d-none">
                                <i class="icon-info-circle text-muted"></i> لا توجد إشعارات جديدة
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown"
                        aria-haspopup="true">
                        <span class="user-name">{{ auth()->user()->name }}</span>
                        <span class="avatar">
                            <div class="header-user">
                                <img src="img/user.png" alt="Admin Template" />
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                        <div class="header-profile-actions">
                            <div class="header-user-profile">
                                <div class="header-user">
                                    <img src="img/user.png" alt="Admin Template" />
                                </div>
                                <h5>{{ auth()->user()->name }}</h5>
                                <p>Admin</p>
                            </div>
                            {{-- <a href="user-profile.html"><i class="icon-user1"></i> My Profile</a>
								<a href="account-settings.html"><i class="icon-settings1"></i> Account Settings</a> --}}
                            <a href="{{ route('logout') }}"><i class="icon-log-out1"></i> تسجيل الخروج</a>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#" class="quick-settings-btn" data-toggle="tooltip" data-placement="left"
                        title="" data-original-title="Quick Settings">
                        <i class="icon-list"></i>
                    </a>
                </li>
            </ul>
            <!-- Header actions end -->
        </div>
    </header>
    <!-- Header end -->

    <!-- Screen overlay start -->
    <div class="screen-overlay"></div>
    <!-- Screen overlay end -->

    <!-- Quicklinks box start -->
    <div class="quick-links-box">
        <div class="quick-links-header">
            Quick Links
            <a href="#" class="quick-links-box-close">
                <i class="icon-circle-with-cross"></i>
            </a>
        </div>

        <div class="quick-links-wrapper">
            <div class="fullHeight">
                <div class="quick-links-body">
                    <div class="container-fluid p-0">
                        <div class="row less-gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a href="documents.html" class="quick-tile blue">
                                    <i class="icon-file-text"></i>
                                    Documents
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="crm-dashboard.html" class="quick-tile secondary">
                                    <i class="icon-pie-chart1"></i>
                                    CRM
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="ecommerce-dashboard.html" class="quick-tile blue">
                                    <i class="icon-shopping-cart1"></i>
                                    Ecommerce
                                </a>
                            </div>
                        </div>
                        <div class="row less-gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a href="gallery2.html" class="quick-tile photos lg">
                                    Photos
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="tasks.html" class="quick-tile">
                                    <i class="icon-check-circle"></i>
                                    Tasks
                                </a>
                                <a href="calendar-external-draggable.html" class="quick-tile blue">
                                    <i class="icon-calendar1"></i>
                                    Events
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="chat.html" class="quick-tile blue">
                                    <i class="icon-message-circle"></i>
                                    Chat
                                </a>
                                <a href="default-layout.html" class="quick-tile">
                                    <i class="icon-grid"></i>
                                    Layout
                                </a>
                            </div>
                        </div>
                        <div class="row less-gutters">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="custom-alerts.html" class="quick-tile secondary">
                                    <i class="icon-alert-triangle"></i>
                                    Alerts
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="google-maps.html" class="quick-tile blue">
                                    <i class="icon-map-pin"></i>
                                    Maps
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="https://www.gmail.com" target="_blank" class="quick-tile white">
                                    <i class="icon-drafts"></i>
                                    Gmail
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="https://www.youtube.com" target="_blank" class="quick-tile secondary">
                                    <i class="icon-youtube"></i>
                                    Youtube
                                </a>
                            </div>
                        </div>
                        <div class="row less-gutters">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="user-profile.html" class="quick-tile">
                                    <i class="icon-account_circle"></i>
                                    Profile
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="contacts.html" class="quick-tile">
                                    <i class="icon-phone"></i>
                                    Contacts
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="account-settings.html" class="quick-tile">
                                    <i class="icon-settings1"></i>
                                    Settings
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <a href="login.html" class="quick-tile">
                                    <i class="icon-lock2"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quicklinks box end -->

    <!-- Quick settings start -->
    <div class="quick-settings-box">
        <div class="quick-settings-header">
            <div class="date-container">Today <span class="date" id="today-date"></span></div>
            <a href="#" class="quick-settings-box-close">
                <i class="icon-circle-with-cross"></i>
            </a>
        </div>
        <div class="quick-settings-body">
            <div class="fullHeight">
                <div class="quick-setting-list">
                    <h6 class="title">Events</h6>
                    <ul class="list-items">
                        <li>
                            <div class="list-title">Product Launch</div>
                            <div class="list-location">10:00 AM</div>
                        </li>
                        <li>
                            <div class="list-title">Team Meeting</div>
                            <div class="list-location">01:30 PM</div>
                        </li>
                        <li>
                            <div class="list-title">Q&A Session</div>
                            <div class="list-location">02:30 PM</div>
                        </li>
                    </ul>
                </div>
                <div class="quick-setting-list">
                    <h6 class="title">Notes</h6>
                    <ul class="list-items">
                        <li>
                            <div class="list-title">Refreshing the list</div>
                            <div class="list-location">03:15 PM</div>
                        </li>
                        <li>
                            <div class="list-title">Not able to click on button</div>
                            <div class="list-location">03:18 PM</div>
                        </li>
                    </ul>
                </div>
                <div class="quick-setting-list">
                    <h6 class="title">Quick Settings</h6>
                    <ul class="set-priority-list">
                        <li>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" checked id="systemUpdates">
                                <label class="custom-control-label" for="systemUpdates">System Updates</label>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="noti">
                                <label class="custom-control-label" for="noti">Notifications</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick settings end -->

    <!-- *************
   ************ Header section end *************
  ************* -->

    <!-- Container fluid start -->
    <div class="container-fluid">

        <!-- Navigation start -->
        @include('dashboard.layouts.navbar')
        <!-- Navigation end -->

        <!-- *************
    ************ Main container start *************
   ************* -->
        <div class="main-container">

            <!-- مساحة لعرض أخطاء JavaScript -->
            <div class="show-errors"></div>

            @yield('content')

        </div>
        <!-- *************
    ************ Main container end *************
   ************* -->

        <!-- Footer start -->
        <footer class="main-footer">© Eata 2024</footer>
        <!-- Footer end -->

    </div>
    <!-- Container fluid end -->

    <!-- *************
   ************ Required JavaScript Files *************
  ************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('dashboard') }}/js/jquery.min.js"></script>
    <script src="{{ asset('dashboard') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dashboard') }}/js/moment.js"></script>

    <!-- CSRF Token Setup for Ajax Requests -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('dashboard') }}/vendor/slimscroll/slimscroll.min.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/slimscroll/custom-scrollbar.js"></script>

    <!-- Error Handler Script - قبل جميع المكتبات الأخرى -->
    <script src="{{ asset('dashboard') }}/js/error-handler.js"></script>

    <!-- Daterange -->
    <script src="{{ asset('dashboard') }}/vendor/daterange/daterange.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/daterange/custom-daterange.js"></script>

    <!-- Data Tables -->
    <script src="{{ asset('dashboard') }}/vendor/datatables/dataTables.min.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/datatables/custom/custom-datatables.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/datatables/custom/fixedHeader.js"></script>

    <!-- Download / CSV / Copy / Print -->
    <script src="{{ asset('dashboard') }}/vendor/datatables/buttons.min.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/datatables/jszip.min.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/datatables/pdfmake.min.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/datatables/vfs_fonts.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/datatables/html5.min.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/datatables/buttons.print.min.js"></script>

    <!-- *************
   ************ Vendor Js Files *************
  ************* -->

    <!-- Chartist JS - مع التحقق من تحميل المكتبة قبل استخدامها -->
    <script>
        // تحميل Chartist بعد التحقق من وجود العناصر
        if (document.querySelector('.ct-chart')) {
            document.write('<script src="{{ asset("dashboard") }}/vendor/chartist/js/chartist.min.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/chartist/js/chartist-tooltip.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/chartist/js/custom/threshold/threshold.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/chartist/js/custom/bar/bar-chart-dashboard.orders.js"><\/script>');
        }
    </script>

    <!-- jVector Maps - مع التحقق من وجود العناصر -->
    <script>
        // تحميل jVector Maps بعد التحقق من وجود العناصر
        if (document.getElementById('world-map-markers')) {
            document.write('<script src="{{ asset("dashboard") }}/vendor/jvectormap/jquery-jvectormap-2.0.3.min.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/jvectormap/world-mill-en.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/jvectormap/gdp-data.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/jvectormap/custom/world-map-markers2.js"><\/script>');
        }
    </script>

    <!-- Rating JS -->
    <script src="{{ asset('dashboard') }}/vendor/rating/raty.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/rating/raty-custom.js"></script>

    <!-- Circliful js -->
    <script src="{{ asset('dashboard') }}/vendor/circliful/circliful.min.js"></script>
    <script src="{{ asset('dashboard') }}/vendor/circliful/circliful.custom.js"></script>

    <!-- Apex Charts - مع التحقق من وجود العناصر -->
    <script>
        // تحميل ApexCharts بعد التحقق من وجود العناصر
        var apexChartsElements = document.querySelectorAll('[id^="apex-"]');
        if (apexChartsElements.length > 0) {
            document.write('<script src="{{ asset("dashboard") }}/vendor/apex/apexcharts.min.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/apex/project-dashboard/timeline.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/apex/project-dashboard/avg-handle-time.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/apex/project-dashboard/budget.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/apex/project-dashboard/tasks-assigned.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/apex/ecommerce-dashboard/by-device.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/apex/ecommerce-dashboard/by-customer-type.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/apex/ecommerce-dashboard/by-channel.js"><\/script>');
            document.write('<script src="{{ asset("dashboard") }}/vendor/apex/ecommerce-dashboard/orders-visits-bouncerate.js"><\/script>');
        }
    </script>

    <!-- Main Js Required -->
    <script src="{{ asset('dashboard') }}/js/main.js"></script>
    @yield('scripts')

</body>

</html>
