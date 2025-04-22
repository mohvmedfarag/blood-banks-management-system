<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.website.head')

<body>
    <!-- Header Section -->
    @include('layouts.website.header')

    <button type="button" id="scroll"><i class="fa-solid fa-arrow-up"></i></button>

    @yield('content')

    

    <!-- Footer Section -->
    @include('layouts.website.footer')


    <script src="{{ asset('assets/website/js/home.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8ajS_b19xd9iUsx7ABgpvKjK1ipg0lzM&callback=initMap" async defer></script>
</body>
<script>
    const background = document.getElementById('background');
    const images = [
        'url("{{ asset('assets/website/photo/pto1.png') }}")',
        'url("{{ asset('assets/website/photo/pto2.png') }}")',
        'url("{{ asset('assets/website/photo/pto3.png') }}")'
        ];
    let currentIndex = 0;

    function changeBackground() {
        currentIndex = (currentIndex + 1) % images.length;
        background.style.backgroundImage = images[currentIndex];
    }

    setInterval(changeBackground, 3000);


    

    
</script>

</html>
