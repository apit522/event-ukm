<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Dashboard
    </title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <!-- <div class="flex"> -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        @include('layout.sidebar')

        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <!-- <div class="flex flex-1 flex-col"> -->
        <!-- ===== Header Start ===== -->

        <!-- ===== Header End ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- ===== Main Content Start ===== -->
            @yield('ukm-dashboard')
            <!-- ===== Main Content End ===== -->
            <!-- </div> -->
            <!-- ===== Content Area End ===== -->
            <!-- </div> -->
            <!-- ===== Page Wrapper End ===== -->
        </div>
    </div>
</body>

</html>