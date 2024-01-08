@extends('ukm-dashboard.master')

@section('ukm-dashboard')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-2/3 lg:w-1/2">
            <div class="bg-white shadow-md rounded-md p-6">
                <div class="text-lg font-semibold mb-4">{{ __('Create Post') }}</div>

                <form method="POST" action="{{ route('submit.post') }}" enctype="multipart/form-data" id="post-form">
                    @csrf

                    <!-- Post Fields -->
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-600">Judul</label>
                        <input type="text" name="judul" class="mt-1 p-2 w-full border rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-600">Deskripsi</label>
                        <textarea name="deskripsi" class="mt-1 p-2 w-full border rounded-md" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="photos" class="block text-sm font-medium text-gray-600">Photos</label>
                        <input type="file" name="photos[]" class="mt-1 p-2 w-full border rounded-md" id="photo-input" multiple required>
                    </div>

                    <!-- Checkbox Event -->
                    <div class="mb-4">
                        <input type="checkbox" class="form-checkbox" id="enable-event">
                        <label class="ml-2 text-sm text-gray-600" for="enable-event">Tambah Event</label>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md" onclick="proceedToEventForm()">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const photoInput = document.getElementById('photo-input');

    photoInput.addEventListener('change', event => {
        // Save the images to sessionStorage
        const photos = event.target.files;
        const photoDataArray = [];

        for (let i = 0; i < photos.length; i++) {
            const reader = new FileReader();
            const photo = photos[i];

            reader.addEventListener('load', () => {
                const photoData = {
                    name: photo.name,
                    type: photo.type,
                    size: photo.size,
                    dataUrl: reader.result,
                };
                photoDataArray.push(photoData);

                if (photoDataArray.length === photos.length) {
                    sessionStorage.setItem('photos', JSON.stringify(photoDataArray));
                }
            });

            if (photo) {
                reader.readAsDataURL(photo);
            }
        }
    });

    function proceedToEventForm() {

        // Cek apakah checkbox event dicentang
        var enableEventCheckbox = document.getElementById('enable-event');
        if (enableEventCheckbox.checked) {
            saveFormDataToSession('post-form', 'postFormData');
            // Redirect ke halaman form event
            window.location.href = "{{ route('event.form') }}";
        } else {
            // Jika checkbox event tidak dicentang, submit form post
            sessionStorage.removeItem('photos');
            document.getElementById('post-form').submit();
        }
    }

    function saveFormDataToSession(formId, sessionKey) {
        var formData = new FormData(document.getElementById(formId));
        var jsonData = {};

        formData.forEach(function(value, key) {
            // Check if the value is a File object
            if (value instanceof FileList) {
                // Convert the FileList to an array of File objects
                const files = [];
                for (let i = 0; i < value.length; i++) {
                    files.push(value[i]);
                }
                jsonData[key] = files;
            } else if (value instanceof File) {
                // Append the File object itself to the JSON data
                jsonData[key] = value;
            } else {
                jsonData[key] = value;
            }
        });

        // Append photo data to JSON data
        const photoData = JSON.parse(sessionStorage.getItem('uploadedImages'));
        if (photoData) {
            jsonData['photos[]'] = photoData;
        }

        sessionStorage.setItem(sessionKey, JSON.stringify(jsonData));
    }
</script>
<!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Post') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('submit.post') }}" enctype="multipart/form-data" id="post-form">
                            @csrf

                            
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" required></textarea>
                            </div>

                           
                            <div class="form-group">
                                <label for="photos">Photos</label>
                                <input type="file" name="photos[]" class="form-control" multiple required>
                            </div>

                            
                            <div id="event-forms" style="display: none;">
                                <div class="form-group">
                                    <label for="event_name">Nama Event</label>
                                    <input type="text" name="event_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="event_description">Deskripsi Event</label>
                                    <textarea name="event_description" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="location">Lokasi</label>
                                    <input type="text" name="location" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="date">Tanggal</label>
                                    <input type="datetime-local" name="date" class="form-control">
                                </div>

                             
                                <div class="form-group event-price-container">
                                    <div class="event-price">
                                    
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm add-event-price" onclick="addEventPrice()">Tambah Harga Event</button>
                                </div>

                            </div>

                            <button type="button" class="btn btn-primary" onclick="toggleEventForms()">Toggle Event Forms</button>

                        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

<!-- <script>
        function toggleEventForms() {
            addEventPrice();
            var eventForms = document.getElementById('event-forms');
            var eventPriceContainer = document.getElementById('event-price-container');
            var eventPresaleContainer = document.getElementById('event-presale-container');

            // Toggle display for event forms
            eventForms.style.display = eventForms.style.display === 'none' ? 'block' : 'none';

            // Toggle display for event price container
            eventPriceContainer.style.display = eventForms.style.display === 'block' ? 'block' : 'none';

            // Toggle display for event presale container
            eventPresaleContainer.style.display = eventForms.style.display === 'block' ? 'block' : 'none';

            // Mengumpulkan data formulir
            var formData = new FormData(document.getElementById('post-form'));

            // Mengonversi FormData ke objek JSON
            var jsonData = {};
            formData.forEach(function(value, key) {
                jsonData[key] = value;
            });

            // Menampilkan data yang dikirimkan di console
            console.log(jsonData);

            // Mengirimkan data ke server menggunakan Ajax
            // Gantilah URL sesuai kebutuhan Anda
            fetch("{{ route('submit.post') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify(jsonData),
                })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error("Error:", error));

            // Trigger addEventPrice when toggling the form
        }


        function addEventPrice() {
            var eventPriceContainer = document.querySelector('#event-forms .event-price-container');
            var eventPriceCount = eventPriceContainer.querySelectorAll('.event-price-item').length;

            var newEventPrice = document.createElement('div');
            newEventPrice.className = 'event-price-item';

            // Incrementing label for event price
            var labelEventPrice = document.createElement('label');
            labelEventPrice.innerHTML = `<strong>Event Price ${eventPriceCount + 1}</strong>`;
            newEventPrice.appendChild(labelEventPrice);

            newEventPrice.innerHTML += `
        <br><label for="event_prices[${eventPriceCount}][nama_variant]">Nama Variant</label>
        <input type="text" name="event_prices[${eventPriceCount}][nama_variant]" class="form-control" required>

        <label for="event_prices[${eventPriceCount}][price]">Harga</label>
        <input type="number" name="event_prices[${eventPriceCount}][price]" class="form-control" required>

        <label for="event_prices[${eventPriceCount}][max_visitor]">Max Pengunjung</label>
        <input type="number" name="event_prices[${eventPriceCount}][max_visitor]" class="form-control" required>

        <div id="event-presale-container-${eventPriceCount}" class="form-group event-presale-container">
            <label>Event Presales</label>
        
            <div class="event-presale">
            </div>
            <button type="button" class="btn btn-success btn-sm add-event-presale" onclick="addEventPresale(${eventPriceCount})">Tambah Presale</button>
        </div>
    `;

            eventPriceContainer.appendChild(newEventPrice);

            // Remove and re-add the "Tambah Harga Event" button
            var addEventPriceButton = eventPriceContainer.querySelector('.add-event-price');
            addEventPriceButton.remove();

            // Add the button back below the newly added event price
            eventPriceContainer.appendChild(addEventPriceButton);
        }

        function addEventPresale(eventPriceIndex) {
            var eventPresaleContainer = document.getElementById(`event-presale-container-${eventPriceIndex}`);
            var eventPresaleCount = eventPresaleContainer.querySelectorAll('.form-group').length;

            var newEventPresale = document.createElement('div');
            newEventPresale.className = 'form-group event-presale-item';

            newEventPresale.innerHTML = `
       
        <label><strong>Event Presale ${eventPresaleCount + 1}</strong></label>
<br>
<label for="event_prices[${eventPriceIndex}][presales][${eventPresaleCount}][variant]">Presale Name</label>
        <input type="text" name="event_prices[${eventPriceIndex}][presales][${eventPresaleCount}][variant]" class="form-control" required>
        <label for="event_prices[${eventPriceIndex}][presales][${eventPresaleCount}][discount]">Diskon</label>
        <input type="number" name="event_prices[${eventPriceIndex}][presales][${eventPresaleCount}][discount]" class="form-control" required>

        <label for="event_prices[${eventPriceIndex}][presales][${eventPresaleCount}][start_date]">Tanggal Mulai</label>
        <input type="datetime-local" name="event_prices[${eventPriceIndex}][presales][${eventPresaleCount}][start_date]" class="form-control" required>

        <label for="event_prices[${eventPriceIndex}][presales][${eventPresaleCount}][due_to]">Batas Waktu</label>
        <input type="datetime-local" name="event_prices[${eventPriceIndex}][presales][${eventPresaleCount}][due_to]" class="form-control" required>

        <label for="event_prices[${eventPriceIndex}][presales][${eventPresaleCount}][max_purchase]">Maksimal Pembelian</label>
        <input type="number" name="event_prices[${eventPriceIndex}][presales][${eventPresaleCount}][max_purchase]" class="form-control" required>
    `;

            eventPresaleContainer.appendChild(newEventPresale);

            // Remove the existing "Tambah Presale" button
            var addEventPresaleButton = eventPresaleContainer.querySelector('.add-event-presale');
            addEventPresaleButton.remove();

            // Move "Tambah Presale" button to the bottom of the container
            eventPresaleContainer.appendChild(addEventPresaleButton);
        }
    </script> -->
@endsection