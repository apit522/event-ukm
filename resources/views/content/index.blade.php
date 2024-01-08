@extends('welcome')

@section('content')
    <div class="pagination justify-content-center">
        {{ $data->links() }}
    </div>
    <div>
        @foreach ($latestPosts as $post)
            <div class="bg-center w-full h-screen-80 bg-no-repeat bg-secondary bg-blend-multiply">
                <div class="flex flex-row items-start mx-36">
                    <div class="max-w-screen-2xl lg:py-56 w-full">
                        <p class="text-2xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                            {{ $post['judul'] }}
                        </p>
                        <div class="w-[500px] pt-3 ">
                            <p class="text-lg text-white line-clamp-3 min-h-[2em]">{{ $post['description'] }}</p>
                        </div>

                        <div class="flex flex-col space-y-4 mt-10 sm:flex-row sm:justify-start sm:space-y-0">
                            <button   onclick="redirectToPostWithScroll({{ $post['id'] }})" class="bg-orange-500 hover:bg-orange-300 mr-10 text-white font-bold py-2 px-4 rounded">
                                Buy Ticket
                            </button>
                            <button
                                class="bg-transparent border-ping hover:border-blue-500 text-ping font-semibold hover:text-white py-2 px-4 border hover:bg-blue-500 rounded">
                                <a href="{{ URL::to('/post/' . $post['id']) }}"">Buy Ticket</a>
                            </button>
                        </div>
                    </div>
                    @if (count($post['images']) > 1)
                        <div
                            class="relative h-screen-80 overflow-hidden  bg-white bg-clip-border text-gray-700 shadow-md mb-3">
                            <div data-carousel="slide" id="default-carousel"
                                class="relative flex flex-col max-w-[24rem] rounded-xl bg-white bg-clip-border carousel-container text-gray-700 shadow-md mb-3">
                                <div class="relative h-screen-80 overflow-hidden">
                                    @foreach ($post['images'] as $image)
                                        <div data-carousel-item>
                                            <img src="{{ $image }}" class="h-screen-80] " alt="Poster" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div
                            class="relative h-screen-80  overflow-hidden  bg-white bg-clip-border text-gray-700 shadow-md mb-3">
                            @foreach ($post['images'] as $image)
                                <img src="{{ $image }}" class="h-screen-80" alt="Poster" />
                            @endforeach
                        </div>
                    @endif
                    {{-- <div class="rounded-sm h-screen-80  shadow-2xl  w-poster">
                        <img src="{{ $post['images'][0] }}" class="shadow-2xl h-screen-80 w-poster rounded-sm"
                            alt="">
                    </div> --}}


                </div>
        @endforeach
    </div>



    </div>

    <div class="bg-ungu">
        {{-- card event --}}
        <div class="py-12">
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-32 mx-auto max-w-screen-lg">
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
                                    <a href="{{ URL::to('/post/' . $post['id']) }}">Lihat Detail</a>

                                </div>
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

            var url = window.location.origin + '/post/' + postId;


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

<script>
    function redirectToPostWithScroll(postId) {
        // Set hash dalam URL dengan nilai postId
        window.location.href = '/post/' + postId + '#containerTarget';
    }
</script>
@endsection
