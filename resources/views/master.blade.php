<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tes</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <livewire:navbar />

    @yield('content')
    @include('livewire.footer')

    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
