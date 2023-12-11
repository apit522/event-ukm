@extends('welcome')

@section('content')
@foreach ($data as $post)
<div class="post">
    <h2>{{ $post['id'] }}</h2>
    <p>{{ $post['ukm_name'] }}</p>
    <p>{{ $post['description'] }}</p>
    <p>{{ $post['status'] }}</p>
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