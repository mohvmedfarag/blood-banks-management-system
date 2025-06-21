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
</body>
<script>
    const background = document.getElementById('background');
    const images = [
        'url("{{ asset('assets/website/photo/pto1.png') }}")',
        'url("{{ asset('assets/website/photo/pto2.png') }}")',
        'url("{{ asset('assets/website/photo/pto3.png') }}")',
        'url("{{ asset('assets/website/photo/pto5.jpg') }}")'
        ];
    let currentIndex = 0;

    function changeBackground() {
        currentIndex = (currentIndex + 1) % images.length;
        background.style.backgroundImage = images[currentIndex];
    }

    setInterval(changeBackground, 3000);





</script>

</html>
