@extends('welcome')

@section('content')

<div class="post">
    <h1>judul post :{{ $post->judul }}</h1>
    @foreach ($post->images as $image)
    <img src="{{$image}}" alt="" style="width: 40vh;">
    @endforeach
    <h2>Post id :{{ $post['id'] }}</h2>
    <img src="{{$post->ukm->profile_picture}}" alt="" style="width: 40vh;">
    <p>ukm name : {{ $post['ukm_name'] }}</p>
    <p>{{ $post['dibuat'] }}</p>
    <p>ukm id : {{ $post->ukm->id }}</p>
    <p>post description : {{ $post['description'] }}</p>
    @if ($post->event)
    <p>judul event : {{ $post->event->name }}</p>
    <p>event description : {!! $post->event->formatted_description !!}</p>
    @endif

    @if ($post->event)
    <h4>Event Presale Details</h4>
    <ul>
        @foreach($post->event->event_presale as $presale)
        <li>
            Variant: {{ $presale->variant }},
            Discount: {{ $presale->discount }}%,
            Start Date: {{ $presale->start_date ?? 'N/A' }},
            Due To: {{ $presale->due_to ?? 'N/A' }},
            Max Purchase: {{ $presale->max_purchase ?? 'N/A' }}
        </li>
        @endforeach
    </ul>
    @endif
</div>

<div id="disqus_thread"></div>
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
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<!-- Isi halaman Home di sini -->
@endsection