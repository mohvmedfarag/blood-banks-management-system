<!DOCTYPE html>
<html lang="en">
@include('dashboard.patient.layout.head')
<style>
    .badge{
        display: inline-block;
        color: #fff;
        width: 15px;
    height: 15px;
    background-color: #f03939;
    border-radius: 50%;
    text-align: center;
    position: relative;
    font-size: 10px;
    line-height: 18px;
    top: -11px;
    right: 6px;
    cursor: pointer;
    }
</style>
<body>
@include('dashboard.patient.layout.header')
    <div class="continer">
        @if(Auth::guard('patient')->check())
        <aside class="sidebar">
            <ul>
                <li><a href="{{route('patient.dashboard')}}" class="{{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">Profile <i class="fa-regular fa-user"></i></a></li>
                <li><a href="{{route('patient.BloodRequests')}}" class="{{ request()->routeIs('patient.BloodRequests') ? 'active' : '' }}">My Requests <i class="fa-solid fa-list-ul"></i></a></li>
                <li><a href="{{route('patient.new.blood.request')}}" class="{{ request()->routeIs('patient.new.blood.request') ? 'active' : '' }}">Blood Request <i class="fa-solid fa-hand-holding-droplet"></i></a></li>
                <li>
                    <a href="{{ route('patient.showNotifications') }}"
                       class="{{ request()->routeIs('patient.showNotifications') ? 'active' : '' }}">
                      Notifications <i class="fa-regular fa-bell"></i>
                      @php $unread = auth('patient')->user()->unreadNotifications->count(); @endphp
                      @if($unread > 0)
                        <span class="badge">{{ $unread }}</span>
                      @endif
                    </a>
                  </li>
                  
                <li><a href="{{route('patient.setting')}}" class="{{ request()->routeIs('patient.setting') ? 'active' : '' }}">Settings <i class="fa-solid fa-gear"></i></a></li>
            </ul>
        </aside>
    @endif
    
    @if(Auth::guard('donor')->check())
        <aside class="sidebar">
            <ul>
                <li><a href="{{route('donor.dashboard')}}" class="{{ request()->routeIs('donor.dashboard') ? 'active' : '' }}">Profile <i class="fa-regular fa-user"></i></a></li>
                <li><a href="{{route('donor.donations')}}" class="{{ request()->routeIs('donor.donations') ? 'active' : '' }}">Donations <i class="fa-solid fa-list-ul"></i></a></li>
                <li><a href="{{route('donor.new.donate.request')}}" class="{{ request()->routeIs('donor.new.donate.request') ? 'active' : '' }}">New Donation <i class="fa-solid fa-hand-holding-droplet"></i></a></li>
                <li><a href="#">Notifications <i class="fa-regular fa-bell"></i></a></li>
                <li><a href="{{route('donor.setting')}}" class="{{ request()->routeIs('patient.setting') ? 'active' : '' }}">Settings <i class="fa-solid fa-gear"></i></a></li>
            </ul>
        </aside>
    @endif
    

    @yield('content')
    </div>

@include('dashboard.patient.layout.footer')
<script src="{{asset('assets/donor/')}}js/pro.js"></script>
</body>
</html>
