<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\EventPresale;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index($id)
    {
        $post = Post::with('event.event_presale')->find($id);


        return view('content.post', compact('post'));
    }

    public function formShow()
    {
        return view('form.post');
    }
    public function formEventShow()
    {
        return view('form.event');
    }

    public function submitPost(Request $request)
    {

        // Validasi akan dilakukan di dalam PostRequest
        $validatedData = $request->all();

        // Buat post
        $post = Post::create([
            'ukm_id' => auth('ukm')->user()->id,
            'judul' => $validatedData['judul'],
            'description' => $validatedData['deskripsi'],
        ]);
        $images = $request->file('photos');

        foreach ($images as $key => $image) {
            $fileUrl = $this->storePhoto($image);

            // Tentukan apakah foto ini adalah cover
            $isCover = $key === 0;

            $post->post_photo()->create([
                'file' => $fileUrl,
                'cover' => $isCover,
            ]);
        }

        // Buat event jika data event ada
        if ($request->filled('event_name')) {
            $eventData = $request->only(['event_name', 'event_description', 'location', 'date']);
            $event = $post->event()->create([
                'name' => $eventData['event_name'],
                'description' => $eventData['event_description'],
                'location' => $eventData['location'],
                'date' => $eventData['date'],
            ]);

            // Buat event prices dan presales
            foreach ($validatedData['event_prices'] as $key => $eventPriceData) {
                $eventPrice = $event->event_price()->create([
                    'variant' => $eventPriceData['nama_variant'],
                    'price' => $eventPriceData['price'],
                    'max_visitor' => $eventPriceData['max_visitor'],
                ]);

                if (isset($eventPriceData['presales'])) {
                    foreach ($eventPriceData['presales'] as $presaleData) {

                        $presaleData['event_id'] = $event->id;
                        $presaleData['event_price_id'] = $eventPrice->id;

                        EventPresale::create($presaleData);
                    }
                } else {
                    $presaleData = [
                        'variant' => 'sale',
                        'discount' => 0,
                        'start_date' => now(),
                        'due_to' => $eventData['date'],
                        'max_purchase' => null,
                        'event_id' => $event->id,
                        'event_price_id' => $eventPrice->id,
                    ];
                    EventPresale::create($presaleData);
                }
            }
        }

        $dashboardUrl = route('dashboard');

        return redirect($dashboardUrl);
    }


    private function storePhoto($photo)
    {
        // Generate a unique filename
        $fileName = time() . '_' . $photo->getClientOriginalName();

        // Store the file in the 'public' disk under the 'post-photos' directory
        $filePath = $photo->storeAs('post-photos', $fileName, 'public');

        // Return the URL to the stored file
        return asset('storage/' . $filePath);
    }
}
