<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @livewireStyles
</head>

<body>
    <livewire:DashboardAdmin />

    <div class="p-4">
        <div class="p-4 border-2 ml-64 border-gray-200 border-dashed rounded-lg dark:border-gray-700">


            @yield('content')


        </div>
    </div>



    {{-- @include('livewire.footer') --}}

    @livewireScripts
</body>

</html>
