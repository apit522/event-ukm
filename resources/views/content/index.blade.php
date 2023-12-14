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
    <p>ukm name : {{ $post['ukm_name'] }}</p>
    <p>description : {{ $post['description'] }}</p>
    <p>status : {{ $post['status'] }}</p>
    <p>{{ $post['dibuat'] }}</p>
    @foreach ($post['images'] as $image)
    <img src="{{$image}}" alt="" style="width: 40vh;">
    @endforeach
</div>
@endforeach

<div class="pagination justify-content-center">
    {{ $data->links() }}
</div>
<!-- Isi halaman Home di sini -->
@endsection