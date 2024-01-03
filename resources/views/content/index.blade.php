@extends('welcome')

@section('content')
    {{--
    @foreach ($latestPosts as $post)
        <div class="cover">
            <h2>Post id : {{ $post['id'] }}</h2>
            <h2>Title: {{ $post['judul'] }}</h2>
            <p>Description: {{ $post['description'] }}</p>
            <p>Event id : {{ $post->event->id }}</p>
            <img src="{{ $post['images'][0] }}" alt="" style="width: 40vh;">
        </div>
    @endforeach
    @foreach ($data as $post)
        <div class="post">
            <h2>Post id :{{ $post['id'] }}</h2>
            <p>ukm name : {{ $post['ukm_username'] }}</p>
            <p>description : {{ $post['description'] }}</p>
            <p>status : {{ $post['status'] }}</p>
            <p>{{ $post['dibuat'] }}</p>
            @foreach ($post['images'] as $image)
                <img src="{{ $image }}" alt="" style="width: 40vh;">
            @endforeach
            <br>
            <button onclick="shareAndCopy({{ $post->id }})">Share</button>
        </div>
    @endforeach --}}

    <div class="pagination justify-content-center">
        {{ $data->links() }}
    </div>
    <div>
        <div class="bg-center w-full h-screen bg-no-repeat bg-secondary bg-blend-multiply">
            <div class="flex flex-row items-start mx-16">
                <div class="max-w-screen-2xl lg:py-56 w-full">
                    <p class="text-2xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                        Music Festival
                    </p>
                    <div class="w-[500px] ">
                        <p class="text-lg text-white line-clamp-3 min-h-[3em]">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                            printer took a galley of type and</p>
                    </div>

                    <div class="flex flex-col space-y-4 mt-10 sm:flex-row sm:justify-start sm:space-y-0">
                        <button class="bg-orange-500 hover:bg-orange-300 mr-10 text-white font-bold py-2 px-4 rounded">
                            Button
                        </button>
                        <button
                            class="bg-transparent border-ping hover:border-blue-500 text-ping font-semibold hover:text-white py-2 px-4 border hover:bg-blue-500 rounded">
                            Button
                        </button>
                    </div>
                </div>
                <img src="{{ asset('images/poster.png') }}" class="h-full w-45 p-3" alt="">
            </div>
        </div>



    </div>

    <div class="bg-ungu">
        {{-- card event --}}
        <div class="py-12">
            <div class="grid grid-cols-1  lg:grid-cols-2 gap-32 mx-auto max-w-screen-lg">
                @foreach ($data as $post)
                    <div
                        class="flex  relative h-[800px] w-[486px] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md mb-3 min-h-[800px]">
                        @if (count($post['images']) > 1)
                            <div
                                class="relative h-[609px] w-[486px] overflow-hidden rounded-t-xl bg-white bg-clip-border text-gray-700 shadow-md mb-3">
                                <div data-carousel="slide" id="default-carousel"
                                    class="relative flex flex-col max-w-[24rem] rounded-t-xl bg-white bg-clip-border carousel-container text-gray-700 shadow-md mb-3">
                                    <div class="relative h-[609px] w-[486px] overflow-hidden">
                                        @foreach ($post['images'] as $image)
                                            <div data-carousel-item>
                                                <img src="{{ $image }}" class="h-[617px] w-[486px] "
                                                    alt="Poster" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div
                                class="relative h-[609px] w-[486px]  overflow-hidden rounded-t-xl bg-white bg-clip-border text-gray-700 shadow-md mb-3">
                                @foreach ($post['images'] as $image)
                                    <img src="{{ $image }}" class="h-[609px] w-[486px]" alt="Poster" />
                                @endforeach
                            </div>
                        @endif

                        <div class="flex items-center py-5 justify-between">
                            <div class="flex  items-center -space-x-3">
                                <div data-tooltip="author-2"
                                    class="absolute z-50  whitespace-normal break-words  px-3 text-2xl font-bold text-black focus:outline-none">
                                    {{ $post['ukm_username'] }}</div>
                            </div>
                            <p class="block text-base font-bold leading-relaxed text-inherit">{{ $post['date'] }}</p>
                        </div>
                        <div class="p-3">
                            <p id="excerpt" class="line-clamp-3 min-h-[3em]">
                                {{ $post['description'] }}
                            </p>
                        </div>
                        <div class="flex-grow"></div>
                        <div class="flex items-center justify-between p-3">
                            <div class="flex items-center -space-x-2">
                                <div data-tooltip="author-2"
                                    class="flex flex-col justify-center whitespace-normal break-words rounded-lg border-[1px] border-black bg-ungu py-1.5 px-3 text-lg h-[60px] items-center text-center font-normal w-[120px] text-white focus:outline-none">
                                    Lihat Detail </div>
                            </div>
                            <div class="flex items-center -space-x-2">
                                <div data-tooltip="author-2"
                                    class="flex flex-col justify-center whitespace-normal break-words rounded-lg border-[1px] border-black bg-ungu py-1.5 px-3 text-lg h-[60px] items-center  text-center font-normal w-[120px] text-white focus:outline-none">
                                    Komentar </div>
                            </div>

                            <div data-tooltip="author-2"
                                class="flex flex-col whitespace-normal break-words rounded-lg border-[1px] border-black bg-ungu py-1.5 px-3 text-lg h-[60px]  text-center  justify-center font-normal w-[120px] text-white focus:outline-none">
                                Bagikan </div>



                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <script>
        function shareAndCopy(postId) {
            // Membuat URL dengan menambahkan ukmId ke URL saat ini
            var url = window.location.origin + '/post/' + postId;

            // Memulai proses penyalinan
            copyToClipboard(url);

            // Mengirimkan permintaan ke server untuk mencatat share
            fetch(`/share-post/${postId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({}),
                })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
        }

        function copyToClipboard(url) {
            // Membuat elemen textarea sementara
            var textarea = document.createElement('textarea');
            textarea.value = url;

            // Menambahkan elemen textarea ke dalam dokumen
            document.body.appendChild(textarea);

            // Memilih dan menyalin teks dalam elemen textarea
            textarea.select();
            document.execCommand('copy');

            // Menghapus elemen textarea sementara
            document.body.removeChild(textarea);

            // Menampilkan pemberitahuan atau melakukan tindakan lainnya
            alert('Link copied to clipboard!');
        }
    </script>
@endsection
