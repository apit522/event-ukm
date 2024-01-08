@extends('ukm-dashboard.master')

@section('ukm-dashboard')
<div class="flex flex-wrap justify-center gap-6 mt-12">
    <a class="relative" href="#postingan" id="post-tab">
        <span class="absolute top-0 left-0 mt-1 ml-1 h-full w-full rounded bg-black"></span>
        <span class="fold-bold relative inline-block h-full w-full rounded border-2 border-black bg-yellow-400 px-3 py-1 text-base font-bold text-gray-900 transition duration-100 hover:bg-white hover:text-black dark:bg-transparent">table post</span>
    </a>
    <a href="#event" id="event-tab" class="relative">
        <span class="absolute top-0 left-0 mt-1 ml-1 h-full w-full rounded bg-gray-700"></span>
        <span class="fold-bold relative inline-block h-full w-full rounded border-2 border-black bg-black px-3 py-1 text-base font-bold text-white transition duration-100 hover:bg-gray-900 hover:text-yellow-500 dark:bg-black">table event</span>
    </a>
</div>

<div id="postingan">
    <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-blueGray-700">Postingan</h3>
                    </div>
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                        <a href="/form/post" class="bg-gray-900 text-white active:bg-gray-900 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 hover:bg-yellow-400 hover:text-black">Tambah Postingan</a>
                    </div>
                </div>
            </div>

            <div class="block w-full overflow-x-auto">
                <table class="items-center bg-transparent w-full border-collapse ">
                    <thead>
                        <tr>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                No
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Judul
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Visitor
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $index => $x)
                        <tr>
                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                {{$index+1}}
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                                {{$x->judul}}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{$x->traffic_count}}
                            </td>
                            <td class="flex flex-row border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <a href="/post/{{$x->id}}" class="mr-4"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 15">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 7.5h11m0 0L8 3.786M12 7.5l-4 3.714M12 1h3c.53 0 1.04.196 1.414.544.375.348.586.82.586 1.313v9.286c0 .492-.21.965-.586 1.313A2.081 2.081 0 0 1 15 14h-3" />
                                    </svg></a>
                                <a href=""><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                    </svg></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="event" class="hidden">
    <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-blueGray-700">Event</h3>
                    </div>
                </div>
            </div>

            <div class="block w-full overflow-x-auto">
                <table class="items-center bg-transparent w-full border-collapse ">
                    <thead>
                        <tr>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                No
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Name
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Attendants
                            </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Max Attendants
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $listy = 0; ?>
                        @foreach($data as $index => $x)
                        @if($x->event)
                        <tr>
                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                {{++$listy}}
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                                {{$x->event->name}}
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                @foreach($x->event->attendant as $y)
                                {{$y->variant}} : {{$y->totalQuantity}}
                                @endforeach
                            </td>
                            <td class="flex flex-row border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                @foreach($x->event->max_visitor as $y)
                                {{$y->variant}} : {{$y->max_visitor}}
                                @endforeach
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<script>
    // Menangani perubahan tab untuk menampilkan tabel yang sesuai
    // Menangani klik pada tombol post
    document.getElementById('post-tab').addEventListener('click', function() {
        document.getElementById('postingan').classList.remove('hidden');
        document.getElementById('event').classList.add('hidden');

        // Hapus kelas hover dan tambahkan kelas non-hover pada tombol post
        this.children[1].classList.remove('hover:bg-yellow-400', 'hover:text-gray-900', 'text-black', 'bg-white');
        this.children[1].classList.add('bg-yellow-400', 'text-gray-900', 'hover:bg-white', 'hover:text-black');

        // Tambahkan kelas hover dan hapus kelas non-hover pada tombol event
        document.getElementById('event-tab').children[1].classList.add('hover:bg-gray-900', 'hover:text-yellow-500', 'bg-black', 'text-white');
        document.getElementById('event-tab').children[1].classList.remove('hover:bg-black', 'hover:text-white', 'text-yellow-500', 'bg-gray-900');
    });

    document.getElementById('event-tab').addEventListener('click', function() {
        document.getElementById('postingan').classList.add('hidden');
        document.getElementById('event').classList.remove('hidden');

        // Hapus kelas hover dan tambahkan kelas non-hover pada tombol event
        this.children[1].classList.remove('hover:bg-gray-900', 'hover:text-yellow-500', 'bg-black', 'text-white');
        this.children[1].classList.add('hover:bg-black', 'hover:text-white', 'text-yellow-500', 'bg-gray-900');
        // Tambahkan kelas hover dan hapus kelas non-hover pada tombol post
        document.getElementById('post-tab').children[1].classList.add('hover:bg-yellow-400', 'hover:text-gray-900', 'text-black', 'bg-white');
        document.getElementById('post-tab').children[1].classList.remove('bg-yellow-400', 'text-gray-900', 'hover:bg-white', 'hover:text-black');
    });
</script>
@endsection