@extends('master')

@section('content')
<!-- component -->
<div class="font-sans leading-none bg-grey-lighter mb-8">
    <div class="container mx-auto">
        <div class="mt-20 bg-white shadow rounded-lg text-gray-900">
            <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
                <img class="object-cover object-center h-32" src='{{$ukm->profile_picture}}' alt='Woman looking front'>
            </div>
            <div class="text-center mt-2">
                <h2 class="font-semibold">{{$ukm->username}}</h2>
                <p class="text-gray-500">{{$ukm->name}}</p>
            </div>
            <ul class="py-4 mt-2 text-gray-700 flex items-center justify-around">
                <li class="flex flex-col items-center justify-around">
                    <h3 class="font-semibold">Post</h3>
                    <div>{{$ukm->post_count}}</div>
                </li>
                <li class="flex flex-col items-center justify-between">
                    <h3 class="font-semibold">Event</h3>
                    <div>{{$ukm->event_count}}</div>
                </li>
                <li class="flex flex-col items-center justify-around">
                    <h3 class="font-semibold">Dibuat</h3>
                    <div>{{ \Carbon\Carbon::parse($ukm->created_at)->format('j F Y') }}</div>
                </li>
            </ul>
            <div class="p-4 border-t mx-8 mt-2">
                <button onclick="shareAndCopyUKM()" class="w-1/4 block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2">Share</button>
            </div>
        </div>
        <div class="ml-20 mr-48">
            <div class="flex mt-3">
                <div class="w-2/5">
                    <div class="bg-white mr-4 p-4 shadow">
                        <div>
                            Intro
                        </div>
                        <div class="text-center border-b py-4 text-xs">
                            {!!$ukm->formatted_description!!}
                        </div>
                        <div class="flex flex-col items-center justify-center border-t py-3">
                            <div>
                                @if($ukm->instagram)
                                <a href="{{$ukm->instagram}}" class="appearance-none p-2 border text-xs text-grey-darker rounded hover:border-black mb-2">
                                    instagram
                                </a>
                                @endif
                                @if($ukm->twitter)
                                <a href="{{$ukm->twitter}}" class="appearance-none p-2 border text-xs text-grey-darker rounded hover:border-black mb-2">
                                    twitter
                                </a>
                                @endif
                            </div>
                            <div class="mt-6">
                                @if($ukm->facebook)
                                <a href="{{$ukm->facebook}}" class="appearance-none p-2 border text-xs text-grey-darker rounded hover:border-black mb-2">
                                    facebook
                                </a>
                                @endif
                                @if($ukm->youtube)
                                <a href="{{$ukm->youtube}}" class="appearance-none p-2 border text-xs text-grey-darker rounded hover:border-black mb-2">
                                    youtube
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-3/5">
                    @foreach($posts as $x)
                    <div class="bg-white shadow mt-4 p-3 pb-0 relative">
                        <div class="flex items-center">
                            <div>
                                <img alt="" class="w-10 h-10 rounded-full" src="{{$ukm->profile_picture}}">
                                </img>
                            </div>
                            <div class="ml-2">
                                <h5>
                                    {{$ukm->name}}
                                </h5>
                                <p class="text-xs font-normal text-grey mt-1">
                                    <span class="cursor-pointer hover:underline">
                                        {{$x->dibuat}}
                                    </span>
                                </p>
                            </div>
                        </div>
                        @if (count($x['images']) > 1)
                        <div class="relative h-[500px] w-full overflow-hidden rounded-t-xl bg-white bg-clip-border text-gray-700 shadow-md mb-3">
                            <div data-carousel="slide" id="default-carousel" class="relative flex flex-col max-w-full rounded-t-xl bg-white bg-clip-border carousel-container text-gray-700 shadow-md mb-3">
                                <div class="relative h-[500px] w-full overflow-hidden mx-auto">
                                    @foreach ($x['images'] as $image)
                                    <div data-carousel-item>
                                        <img src="{{ $image }}" class="h-full w-full object-contain mx-auto" alt="Poster" />
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="relative h-[500px] w-full overflow-hidden mx-auto">
                            @foreach ($x['images'] as $image)

                            <img src="{{ $image }}" class="h-full w-full object-contain mx-auto" alt="Poster" />

                            @endforeach
                        </div>
                        @endif

                        <h5 class="text-sm font-normal my-3 line-clamp-3 min-h-[3em]">
                            {!!nl2br($x->description)!!}
                        </h5>
                        <div class="border">

                        </div>
                        <div class="flex py-1">
                            <a href="{{ URL::to('/post/' . $x['id']) }}" class="appearance-none flex-1 flex items-center justify-center py-2 text-center text-red hover:bg-grey-lighter">
                                <svg class="w-4 h-4 mr-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 15">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 7.5h11m0 0L8 3.786M12 7.5l-4 3.714M12 1h3c.53 0 1.04.196 1.414.544.375.348.586.82.586 1.313v9.286c0 .492-.21.965-.586 1.313A2.081 2.081 0 0 1 15 14h-3" />
                                </svg>

                                Detail
                            </a>
                            <button onclick="redirectToPostWithScroll({{ $x['id'] }})" class="appearance-none flex-1 flex items-center justify-center py-2 text-center text-grey-darker hover:bg-grey-lighter">
                                <svg class="w-4 h-4 mr-1" viewbox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1792 896q0 174-120 321.5t-326 233-450 85.5q-70 0-145-8-198 175-460 242-49 14-114 22-17 2-30.5-9t-17.5-29v-1q-3-4-.5-12t2-10 4.5-9.5l6-9 7-8.5 8-9q7-8 31-34.5t34.5-38 31-39.5 32.5-51 27-59 26-76q-157-89-247.5-220t-90.5-281q0-130 71-248.5t191-204.5 286-136.5 348-50.5q244 0 450 85.5t326 233 120 321.5z">
                                    </path>
                                </svg>
                                Comment
                            </button>
                            <button onclick="shareAndCopyPost({{$x->id}})" class="appearance-none flex-1 flex items-center justify-center py-2 text-center text-grey-darker hover:bg-grey-lighter">
                                <svg class="w-4 h-4 mr-1" viewbox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1792 640q0 26-19 45l-512 512q-19 19-45 19t-45-19-19-45v-256h-224q-98 0-175.5 6t-154 21.5-133 42.5-105.5 69.5-80 101-48.5 138.5-17.5 181q0 55 5 123 0 6 2.5 23.5t2.5 26.5q0 15-8.5 25t-23.5 10q-16 0-28-17-7-9-13-22t-13.5-30-10.5-24q-127-285-127-451 0-199 53-333 162-403 875-403h224v-256q0-26 19-45t45-19 45 19l512 512q19 19 19 45z">
                                    </path>
                                </svg>
                                Share
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <h2>Username UKM: {{ $ukm->username }}</h2>
<h3>Nama UKM: {{ $ukm->name }}</h3>
<h3>Banyak post: {{ $ukm->post_count }} Poster</h3>
<button onclick="shareAndCopy()">Share</button>
<img src="{{$ukm->profile_picture}}" alt="" style="width: 30vh;">
<p>Deskripsi UKM: {{ $ukm->description }}</p>
@if ($ukm->instagram)
<a href="{{ $ukm->instagram }}" target="_blank">Instagram</a>
@endif

@if ($ukm->facebook)
<a href="{{ $ukm->facebook }}" target="_blank">Facebook</a>
@endif

@if ($ukm->twitter)
<a href="{{ $ukm->twitter }}" target="_blank">Twitter</a>
@endif

@if ($ukm->youtube)
<a href="{{ $ukm->youtube }}" target="_blank">Youtube</a>
@endif
<h2>Daftar Posting:</h2>
<ul>
    @foreach ($posts as $post)
    <li>
        <img src="{{$ukm->profile_picture}}" alt="" style="width: 20vh;">
        <h5>{{$ukm->username}}</h5>
        <h5>{{$post->dibuat}}</h5>

        <strong>{{ $post->judul }}</strong><br>
        @foreach ($post['images'] as $image)
        <img src="{{$image}}" alt="" style="width: 30vh;">
        @endforeach
        <p>{{ $post->description }}</p>
    </li>
    @endforeach
</ul> -->

<script>
    function shareAndCopyPost(postId) {

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

    function shareAndCopyUKM() {
        var url = window.location.href;
        copyToClipboard(url);

        // Mengirimkan permintaan ke server untuk mencatat share
        fetch(`/share-ukm/{{$ukm->id}}`, {
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
        // Mengambil URL saat ini


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

    function redirectToPostWithScroll(postId) {
        // Set hash dalam URL dengan nilai postId
        window.location.href = '/post/' + postId + '#disqus_thread';
    }
</script>
@endsection