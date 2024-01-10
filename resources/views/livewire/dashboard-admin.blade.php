<div>



    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <!-- sidebar.blade.php -->
                <li>
                    <a href="{{ url('/admin/transaksi') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group {{ Request::is('admin/transaksi') ? 'selected' : '' }}">
                        <span class="ms-3">Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/ukm') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group {{ Request::is('admin/ukm') ? 'selected' : '' }}">
                        <span class="flex-1 ms-3 whitespace-nowrap">UKM</span>
                    </a>
                </li>




            </ul>
        </div>
    </aside>


    <script>
        // JavaScript (gunakan jQuery atau metode lain sesuai kebutuhan Anda)
        $(document).ready(function() {
            $('.sidebar a').on('click', function() {
                $('.sidebar a').removeClass('selected'); // Hapus kelas 'selected' dari semua elemen
                $(this).addClass('selected'); // Tambahkan kelas 'selected' ke elemen yang diklik
            });
        });
    </script>

</div>
