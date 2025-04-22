<header>
    <div class="up">
        <div class="content-up">
            <a href="{{ route('welcome') }}" class="logo">{{ __('words.logo') }} <i class="fa-solid fa-heart-pulse"></i></a>
            <ul class="ul-up">
                @if (Auth::guard('donor')->check())
                    <li>
                        <form method="post" action="{{ route('donor.logout') }}">
                            @csrf
                            <button type="submit" class="auth-button signup">logout</button>
                        </form>

                    </li>
                @elseif (Auth::guard('patient')->check())
                    <li>
                        <form method="post" action="{{ route('patient.logout') }}">
                            @csrf
                            <button type="submit" class="auth-button signup">logout</button>
                        </form>

                    </li>
                    @elseif (Auth::guard('admin')->check())
                    <li>
                        <form method="post" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="auth-button signup">logout</button>
                        </form>

                    </li>
            
                @else
                    <li>
                        <a href="{{ route('chooseLogin') }}" class="auth-button login">{{ __('words.login') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('chooseRegistration') }}"
                            class="auth-button signup">{{ __('words.register') }}</a>
                    </li>
                @endif

                {{-- <form id="form-logout" method="post" action="{{ route('donor.logout') }}">@csrf</form> --}}
            </ul>
            <i id="icon" class="icon-menu i"></i>
        </div>
    </div>
    <div class="down">
        <nav id="nav">
            <ul>
                <li><a href="{{ route('welcome') }}">{{ __('words.home') }}</a></li>
                <li><a href="{{ route('welcome.bloodBanks') }}"> {{__('words.bloodBanks')}} </a></li>
                <li>
                    <a href="{{ request()->routeIs('welcome') ? '#Campaigns' : route('welcome') . '#Campaigns' }}">
                        {{ __('words.campaigns') }}
                    </a>
                </li>
                <li><a href="{{ request()->routeIs('welcome') ? '#about-us' : route('welcome') . '#about-us' }}">{{ __('words.about') }}</a></li>
                <li><a href="{{ request()->routeIs('welcome') ? '#contact-us' : route('welcome') . '#contact-us' }}">{{ __('words.contact') }}</a></li>


                @if (LaravelLocalization::getCurrentLocale() == 'en')
                    <li><a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">العربية</a></li>
                @else
                    <li><a href="{{ LaravelLocalization::getLocalizedURL('en') }}">English</a></li>
                @endif


                @if (Auth::guard('donor')->check())
                    <li><a href="{{ route('donor.dashboard') }}">{{ __('words.dashboard') }}</a></li>
                @elseif (Auth::guard('patient')->check())
                    <li><a href="{{ route('patient.dashboard') }}">{{ __('words.dashboard') }}</a></li>
                @elseif (Auth::guard('admin')->check())
                <li><a href="{{ route('admin.dashboard') }}">{{ __('words.dashboard') }}</a></li>
                @endif
            </ul>
        </nav>
    </div>
</header>
