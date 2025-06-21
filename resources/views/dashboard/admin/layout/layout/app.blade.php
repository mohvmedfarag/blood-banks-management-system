<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/styles.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/profile.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/dashboard.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/requests.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <div class="up">
            <div class="content-up">
                <a href="{{ route('welcome') }}" class="logo">Blood Bank <i class="fa-solid fa-heart-pulse"></i></a>
                <ul class="ul-up">

                    @if (Auth::guard('admin')->check())
                        <li>
                            <a href="javascript:void(0)" onclick="document.getElementById('adminLogout').submit()"
                                class="auth-button login">Logout</a>
                            <form id="adminLogout" method="post" action="{{ route('admin.logout') }}">@csrf</form>
                        </li>
                    @endif

                </ul>

            </div>
        </div>

        <div class="down">
            <nav id="nav">
                <ul>
                    <li><a href="{{ route('welcome.bloodBanks') }}"> Blood Banks </a></li>

                    @if (LaravelLocalization::getCurrentLocale() == 'en')
                        <li><a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">العربية</a></li>
                    @else
                        <li><a href="{{ LaravelLocalization::getLocalizedURL('en') }}">English</a></li>
                    @endif

                    @if (Auth::guard('admin')->check())
                        <li><a href="{{ route('admin.dashboard') }}">{{ __('words.dashboard') }}</a></li>
                    @endif
                </ul>
            </nav>
        </div>

    </header>



        <div class="continer">
            @if (Auth::guard('patient')->check())
                <aside class="sidebar">
                    <ul>
                        <li><a href="#"
                                class="{{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">Profile <i
                                    class="fa-regular fa-user"></i></a></li>
                        <li><a href="{{ route('patient.BloodRequests') }}"
                                class="{{ request()->routeIs('patient.BloodRequests') ? 'active' : '' }}">My Requests
                                <i class="fa-solid fa-list-ul"></i></a></li>
                        <li><a href="{{ route('patient.new.blood.request') }}"
                                class="{{ request()->routeIs('patient.new.blood.request') ? 'active' : '' }}">Blood
                                Request <i class="fa-solid fa-hand-holding-droplet"></i></a></li>
                        <li><a href="#">Notifications <i class="fa-regular fa-bell"></i></a></li>
                        <li><a href="{{ route('patient.setting') }}"
                                class="{{ request()->routeIs('patient.setting') ? 'active' : '' }}">Settings <i
                                    class="fa-solid fa-gear"></i></a></li>
                    </ul>
                </aside>
            @endif

            @if (Auth::guard('donor')->check())
                <aside class="sidebar">
                    <ul>
                        <li><a href="{{ route('donor.dashboard') }}"
                                class="{{ request()->routeIs('donor.dashboard') ? 'active' : '' }}">Profile <i
                                    class="fa-regular fa-user"></i></a></li>
                        <li><a href="{{ route('donor.donations') }}"
                                class="{{ request()->routeIs('donor.donations') ? 'active' : '' }}">Donations <i
                                    class="fa-solid fa-list-ul"></i></a></li>
                        <li><a href="{{ route('donor.new.donate.request') }}"
                                class="{{ request()->routeIs('donor.new.donate.request') ? 'active' : '' }}">New
                                Donation <i class="fa-solid fa-hand-holding-droplet"></i></a></li>
                        <li><a href="#">Notifications <i class="fa-regular fa-bell"></i></a></li>
                        <li><a href="{{ route('donor.setting') }}"
                                class="{{ request()->routeIs('donor.setting') ? 'active' : '' }}">Settings <i
                                    class="fa-solid fa-gear"></i></a></li>
                    </ul>
                </aside>
            @endif

            @if (Auth::guard('admin')->check())
                <aside class="sidebar">
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}"
                                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Profile <i
                                    class="fa-regular fa-user"></i></a></li>
                        <li><a href="{{ route('admin.dashboard.bloodbanks') }}"
                                class="{{ request()->routeIs('admin.dashboard.bloodbanks') ? 'active' : '' }}">Blood
                                Banks <i class="fa-solid fa-house-medical-flag"></i></a></li>
                        <li><a href="{{ route('admin.dashboard.donations') }}"
                                class="{{ request()->routeIs('admin.dashboard.donations') ? 'active' : '' }}">Donations
                                <i class="fa-solid fa-hand-holding-droplet"></i></a></li>
                        <li><a href="{{ route('admin.dashboard.bloodRequests') }}"
                                class="{{ request()->routeIs('admin.dashboard.bloodRequests') ? 'active' : '' }}">Blood
                                Requests <i class="fa-solid fa-droplet"></i></a></li>
                        <li><a href="{{ route('admin.dashboard.donors') }}"
                                class="{{ request()->routeIs('admin.dashboard.donors') ? 'active' : '' }}">Donors <i
                                    class="fa-solid fa-users"></i></a></li>
                        <li><a href="{{ route('admin.dashboard.patients') }}"
                                class="{{ request()->routeIs('admin.dashboard.patients') ? 'active' : '' }}">Patients
                                <i class="fa-solid fa-users"></i></a></li>
                        <li style="display: none"><a href="{{ route('admin.show.admins') }}"
                                class="{{ request()->routeIs('admin.show.admins') ? 'active' : '' }}">Admins <i
                                    class="fa-solid fa-gear"></i></a></li>
                        <li><a href="{{ route('admin.notifications.send') }}"
                                class="{{ request()->routeIs('admin.notifications.send') ? 'active' : '' }}">Send
                                Notifications <i class="fa-solid fa-bell"></i></a></li>
                        <li><a href="{{ route('admin.contacts') }}"
                                class="{{ request()->routeIs('admin.contacts') ? 'active' : '' }}"> Contacts
                                <i class="fa-solid fa-bell"></i></a></li>

                    </ul>
                </aside>
            @endif

            @yield('content')
        </div>

    @include('dashboard.admin.layout.layout.footer')
    <script src="{{ asset('assets/admin/') }}js/pro.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8ajS_b19xd9iUsx7ABgpvKjK1ipg0lzM&callback=initMap" async
        defer></script>
    <script>
        const counters = document.querySelectorAll('.count');
        counters.forEach(counter => {
            counter.innerText = '0';
            const updateCounter = () => {
                const target = +counter.getAttribute('data-target');
                const current = +counter.innerText;
                const increment = target / 100;

                if (current < target) {
                    counter.innerText = Math.ceil(current + increment);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.innerText = target;
                }
            };
            updateCounter();
        });
    </script>
</body>

</html>
