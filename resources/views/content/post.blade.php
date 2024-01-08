@extends('master')

@section('content')
    <div class="bg-ungu flex flex-col justify-center">
        <div class="text-6xl text-white items-center text-center p-7">{{ $post->judul }}</div>
        @if ($post->event)
            <div class="flex flex-row items-center justify-center space-x-6">
                <div class="flex flex-col">
                    @if (count($post['images']) > 1)
                        <div
                            class="relative h-[526px] w-[444px] overflow-hidden rounded-sm bg-white bg-clip-border text-gray-700 shadow-md mb-3">
                            <div data-carousel="slide" id="default-carousel"
                                class="relative flex flex-col max-w-[24rem] rounded-xl bg-white bg-clip-border carousel-container text-gray-700 shadow-md mb-3">
                                <div class="relative h-[526px] w-[444px] overflow-hidden">
                                    @foreach ($post['images'] as $image)
                                        <div data-carousel-item>
                                            <img src="{{ $image }}" class="h-[526px] w-[444px] " alt="Poster" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div
                            class="relative h-[526px] w-[444px]  overflow-hidden rounded-sm bg-white bg-clip-border text-gray-700 shadow-md mb-3">
                            @foreach ($post['images'] as $image)
                                <img src="{{ $image }}" class="h-[526px] w-[444px]" alt="Poster" />
                            @endforeach
                        </div>
                    @endif
                    {{-- card ukm --}}
                    <div class="h-[90px] w-[444px] px-4 bg-white rounded-sm flex items-center space-x-3">
                        <img class="h-[40px] w-[40px]" src="{{ $post->ukm->profile_picture }}">
                        <div class="flex flex-col">
                            <p class="text-lg font-bold">{{ $post['ukm_username'] }}</p>
                            <p class="text-sm">{{ $post->ukm->name }}</p>
                        </div>
                        <p class="text-3xl ps-3">&bull;</p>
                        <p class="text-lg">{{ $post['dibuat'] }}</p>
                    </div>
                </div>
                <div class="flex flex-col space-y-5">
                    <div class="bg-white w-[657px] rounded-sm h-[186px] overflow-y-auto p-4"> {{ $post['description'] }}
                    </div>

                    <div class="bg-white w-[657px] text-center text-3xl font-bold rounded-sm h-[68px] p-4">
                        {{ $post->event->name }}</div>
                    <div class="bg-white w-[657px] rounded-sm h-[332px] overflow-y-auto p-4"> {!! $post->event->formatted_description !!}</div>

                </div>
            </div>

            <div class="bg-white  w-[1127px] mx-auto my-auto flex flex-col items-center mt-3 mb-3 rounded-sm justify-center py-4 "
                id="containerTarget">
                <p class="drop-shadow-2xl font-bold text-5xl">Get Your Ticket</p>
                <p class="text-base text-gray-500">Click on a date to book tickets</p>

                <div
                    class="w-[649px] h-[50px] bg-white rounded-lg flex items-center justify-evenly my-auto mb-3  border-2 border-secondary">

                    <p class="text-secondary">Start date</p>
                    <p>|</p>
                    <p class="text-secondary">End Date</p>
                    <p>|</p>
                    <div class="bg-white p-2 rounded-lg">
                        <p class="text-red-600 w-[60x] text-center font-bold">Type</p>
                    </div>


                </div>
                @foreach ($post->event->event_presale as $presale)
                    <div class="w-[649px] h-[50px] bg-secondary rounded-lg flex items-center justify-evenly my-auto mb-3">

                        <p class="text-white">{{ $presale->start_date ?? 'N/A' }}</p>
                        <p>|</p>
                        <p class="text-white">{{ $presale->due_to ?? 'N/A' }}</p>
                        <p>|</p>
                        <a href="">
                            <div class="bg-white p-2 rounded-lg">
                                <p class="text-red-600 w-[100px] text-center font-bold">
                                    {{ $presale->event_price->variant }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="flex flex-col items-center">
                    @if (count($post['images']) > 1)
                        <div
                            class="relative h-[609px] w-[486px] overflow-hidden rounded-t-xl bg-white bg-clip-border text-gray-700 shadow-md mb-3">
                            <div data-carousel="slide" id="default-carousel"
                                class="relative flex flex-col max-w-[24rem] rounded-t-xl bg-white bg-clip-border carousel-container text-gray-700 shadow-md mb-3">
                                <div class="relative h-[609px] w-[486px] overflow-hidden">
                                    @foreach ($post['images'] as $image)
                                        <div data-carousel-item>
                                            <img src="{{ $image }}" class="h-[617px] w-[486px] " alt="Poster" />
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
                    <div class="bg-white rounded-sm w-[1127px] h-[186px] mb-4 mx-auto items-center p-4">
                        {{ $post['description'] }}
                    </div>
                </div>
        @endif
        <div class="mx-auto bg-ungu h-5 w-[1127px]"></div>
        <div id="disqus_thread"
            class="bg-white  w-[1127px] mx-auto my-auto flex flex-col items-center  rounded-sm justify-center p-10 mb-24"">
        </div>
        <script>
            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */

            var disqus_config = function() {
                var currentUrl = window.location.href;

                // Mengekstrak ID dari URL dengan memisahkan string URL menggunakan '/'
                var urlParts = currentUrl.split('/');
                var postId = urlParts[urlParts.length - 1];

                // Konfigurasi Disqus
                this.page.url = currentUrl;
                this.page.identifier = postId;
            };

            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document,
                    s = d.createElement('script');
                s.src = 'https://event-ukm.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
                Disqus.</a></noscript>






        {{-- <div class="post">
            <h1>judul post :{{ $post->judul }}</h1>
            @foreach ($post->images as $image)
                <img src="{{ $image }}" alt="" style="width: 40vh;">
            @endforeach
            <h2>Post id :{{ $post['id'] }}</h2>
            <img src="{{ $post->ukm->profile_picture }}" alt="" style="width: 40vh;">
            <p>ukm username : {{ $post['ukm_username'] }}</p>
            <p>ukm id : {{ $post->ukm->id }}</p>
            <p>post dibuat : {{ $post['dibuat'] }}</p>
            <p>post description : {{ $post['description'] }}</p>
            @if ($post->event)
                <p>judul event : {{ $post->event->name }}</p>
                <p>event description : {!! $post->event->formatted_description !!}</p>
            @endif

            @if ($post->event)
                <h4>Event Presale Details</h4>
                <ul>
                    @foreach ($post->event->event_presale as $presale)
                        <li>
                            Variant: {{ $presale->variant }},
                            Type: {{ $presale->event_price->variant }},
                            Discount: {{ $presale->discount }}%,
                            Start Date: {{ $presale->start_date ?? 'N/A' }},
                            Due To: {{ $presale->due_to ?? 'N/A' }},
                            Max Purchase: {{ $presale->max_purchase ?? 'N/A' }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div> --}}


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah ada hash dalam URL
            var targetHash = window.location.hash;

            if (targetHash) {
                // Hapus karakter '#' dari hash
                var targetId = targetHash.substring(1);

                // Lakukan scroll ke elemen dengan ID yang sesuai
                var containerTarget = document.getElementById(targetId);
                if (containerTarget) {
                    containerTarget.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    </script>

@endsection
