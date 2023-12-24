@extends('welcome')

@section('content')
@foreach ($latestPosts as $post)
<div class="cover">
    <h2>Post id : {{ $post['id'] }}</h2>
    <h2>Title: {{ $post['judul'] }}</h2>
    <p>Description: {{ $post['description'] }}</p>
    <p>Event id : {{ $post->event->id }}</p>
    <img src="{{$post['images'][0]}}" alt="" style="width: 40vh;">
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
    <img src="{{$image}}" alt="" style="width: 40vh;">
    @endforeach
    <br>
    <button onclick="shareAndCopy({{ $post->id }})">Share</button>
</div>
@endforeach

<div class="pagination justify-content-center">
    {{ $data->links() }}
</div>
<!-- Isi halaman Home di sini -->

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