@extends('welcome')

@section('content')

<h2>Username UKM: {{ $ukm->username }}</h2>
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
</ul>

<script>
    function shareAndCopy() {

        copyToClipboard();

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

    function copyToClipboard() {
        // Mengambil URL saat ini
        var url = window.location.href;

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