@extends('ukm-dashboard.master')

@section('ukm-dashboard')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-2/3 lg:w-1/2">
            <div class="bg-white shadow-md rounded-md p-6">
                <div class="text-lg font-semibold mb-4">{{ __('Create Event') }}</div>

                <form method="POST" action="{{ route('submit.post') }}" enctype="multipart/form-data" id="event-form">
                    @csrf

                    <!-- Event Fields -->
                    <div class="mb-4">
                        <label for="event_name" class="block text-sm font-medium text-gray-600">Nama Event</label>
                        <input type="text" name="event_name" class="mt-1 p-2 w-full border rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="event_description" class="block text-sm font-medium text-gray-600">Deskripsi Event</label>
                        <textarea name="event_description" class="mt-1 p-2 w-full border rounded-md"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-600">Lokasi</label>
                        <input type="text" name="location" class="mt-1 p-2 w-full border rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-600">Tanggal</label>
                        <input type="datetime-local" name="date" class="mt-1 p-2 w-full border rounded-md">
                    </div>

                    <!-- Event Prices -->
                    <div class="mb-4 event-price-container">

                    </div>
                    <div class="mb-4 presale-form-container">

                    </div>
                    <!-- Checkbox Event Presale -->
                    <div class="mb-4">
                        <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-md" onclick="addPresaleForm()">Tambah Event Presale</button>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md" onclick="proceedToPresaleForm()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Event') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('submit.post') }}" enctype="multipart/form-data" id="event-form">
                            @csrf

                           
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

                            </div>
                            <div class="presale-form-container mt-4">

                            </div>
                           
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-sm mt-2" onclick="addPresaleForm()">Tambah Event Presale</button>
                            </div>
                            <br>
                          
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" onclick="proceedToPresaleForm()">Submit</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

<script>
    var eventPriceCount = 0;

    function addPresaleForm() {
        var presaleFormContainer = document.querySelector('.presale-form-container');
        var presaleForms = presaleFormContainer.querySelectorAll('.presale-form');
        var eventPresaleCount = presaleForms.length + 1;
        var newPresaleForm = document.createElement('div');
        newPresaleForm.className = 'presale-form mt-4';

        var labelEventPresale = document.createElement('label');
        labelEventPresale.innerHTML = `<strong>Event Presale ${eventPresaleCount}</strong>`;
        newPresaleForm.appendChild(labelEventPresale);

        for (let i = 0; i < eventPriceCount; i++) {
            if (i == 0) {
                newPresaleForm.innerHTML += `
            <br>
            <div class="mb-4">
                <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][variant]" class="block text-sm font-medium text-gray-600">Variant</label>
                <input type="text" name="event_prices[${i}][presales][${eventPresaleCount - 1}][variant]" class="mt-1 p-2 w-full border rounded-md variant${eventPresaleCount}" id="variant${eventPresaleCount}" onchange="handleChange(this)" required>
            </div>

            <div class="mb-4">
                <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][discount]" class="block text-sm font-medium text-gray-600">Diskon</label>
                <input type="number" name="event_prices[${i}][presales][${eventPresaleCount - 1}][discount]" class="mt-1 p-2 w-full border rounded-md discount${eventPresaleCount}" id="discount${eventPresaleCount}" onchange="handleChange(this)" required>
            </div>

            <div class="mb-4">
                <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][start_date]" class="block text-sm font-medium text-gray-600">Tanggal Mulai</label>
                <input type="datetime-local" name="event_prices[${i}][presales][${eventPresaleCount - 1}][start_date]" class="mt-1 p-2 w-full border rounded-md start${eventPresaleCount}" id="start${eventPresaleCount}" onchange="handleChange(this)" required>
            </div>

            <div class="mb-4">
                <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][due_to]" class="block text-sm font-medium text-gray-600">Batas Waktu</label>
                <input type="datetime-local" name="event_prices[${i}][presales][${eventPresaleCount - 1}][due_to]" class="mt-1 p-2 w-full border rounded-md due-to${eventPresaleCount}" id="due-to${eventPresaleCount}" onchange="handleChange(this)" required>
            </div>

            <div class="mb-4">
                <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][max_purchase]" class="block text-sm font-medium text-gray-600">Maksimal Pembelian Event Price ${i + 1}</label>
                <input type="number" name="event_prices[${i}][presales][${eventPresaleCount - 1}][max_purchase]" class="mt-1 p-2 w-full border rounded-md" required>
            </div>`;
            } else {
                newPresaleForm.innerHTML += `
            <div class="mb-4">
                <input type="text" name="event_prices[${i}][presales][${eventPresaleCount - 1}][variant]" class="form-control variant${eventPresaleCount}" hidden required>
            </div>

            <div class="mb-4">
                <input type="number" name="event_prices[${i}][presales][${eventPresaleCount - 1}][discount]" class="form-control discount${eventPresaleCount}" hidden required>
            </div>

            <div class="mb-4">
                <input type="datetime-local" name="event_prices[${i}][presales][${eventPresaleCount - 1}][start_date]" class="form-control start${eventPresaleCount}" hidden required>
            </div>

            <div class="mb-4">
                <input type="datetime-local" name="event_prices[${i}][presales][${eventPresaleCount - 1}][due_to]" class="form-control due-to${eventPresaleCount}" hidden required>
            </div>

            <div class="mb-4">
                <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][max_purchase]" class="block text-sm font-medium text-gray-600">Maksimal Pembelian Event Price ${i + 1}</label>
                <input type="number" name="event_prices[${i}][presales][${eventPresaleCount - 1}][max_purchase]" class="mt-1 p-2 w-full border rounded-md" required>
            </div>`;
            }
        }

        presaleFormContainer.appendChild(newPresaleForm);
    }

    // function addPresaleForm() {
    //     var presaleFormContainer = document.querySelector('.presale-form-container');
    //     var presaleForms = presaleFormContainer.querySelectorAll('.presale-form');
    //     var eventPresaleCount = presaleForms.length + 1;
    //     var newPresaleForm = document.createElement('div');
    //     newPresaleForm.className = 'presale-form mt-4';

    //     var labelEventPresale = document.createElement('label');
    //     labelEventPresale.innerHTML = `<strong>Event Presale ${eventPresaleCount}</strong>`;
    //     newPresaleForm.appendChild(labelEventPresale);

    //     for (let i = 0; i < eventPriceCount; i++) {
    //         if (i == 0) {
    //             newPresaleForm.innerHTML += ` 
    //         <br> <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][variant]">Variant</label>
    //                             <input type="text" name="event_prices[${i}][presales][${eventPresaleCount - 1}][variant]" class="form-control variant${eventPresaleCount}" id="variant${eventPresaleCount}" onchange="handleChange(this)" required>

    //                             <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][discount]">Diskon</label>
    //                             <input type="number" name="event_prices[${i}][presales][${eventPresaleCount - 1}][discount]" class="form-control discount${eventPresaleCount}" id="discount${eventPresaleCount}" onchange="handleChange(this)" required>

    //                             <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][start_date]">Tanggal Mulai</label>
    //                             <input type="datetime-local" name="event_prices[${i}][presales][${eventPresaleCount - 1}][start_date]" class="form-control start${eventPresaleCount}" id="start${eventPresaleCount}" onchange="handleChange(this)" required>

    //                             <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][due_to]">Batas Waktu</label>
    //                             <input type="datetime-local" name="event_prices[${i}][presales][${eventPresaleCount - 1}][due_to]" class="form-control due-to${eventPresaleCount}" id="due-to${eventPresaleCount}"  onchange="handleChange(this)" required>
    //         <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][max_purchase]">Maksimal Pembelian Event Price ${i+1}</label>
    //                             <input type="number" name="event_prices[${i}][presales][${eventPresaleCount - 1}][max_purchase]" class="form-control" required> `;
    //         } else {
    //             newPresaleForm.innerHTML += ` 
    //                             <input type="text" name="event_prices[${i}][presales][${eventPresaleCount - 1}][variant]" class="form-control variant${eventPresaleCount}" hidden required>

    //                             <input type="number" name="event_prices[${i}][presales][${eventPresaleCount - 1}][discount]" class="form-control discount${eventPresaleCount}" hidden required>


    //                             <input type="datetime-local" name="event_prices[${i}][presales][${eventPresaleCount - 1}][start_date]" class="form-control start${eventPresaleCount}" hidden required>


    //                             <input type="datetime-local" name="event_prices[${i}][presales][${eventPresaleCount - 1}][due_to]" class="form-control due-to${eventPresaleCount}" hidden required>

    //         <label for="event_prices[${i}][presales][${eventPresaleCount - 1}][max_purchase]">Maksimal Pembelian Event Price ${i+1}</label>
    //                             <input type="number" name="event_prices[${i}][presales][${eventPresaleCount - 1}][max_purchase]" class="form-control" required> `;
    //         }

    //     }

    //     presaleFormContainer.appendChild(newPresaleForm);
    // }
    function addEventPrice() {
        var eventPriceContainer = document.querySelector('.event-price-container');
        var existingEventPrices = eventPriceContainer.querySelectorAll('.event-price-item');
        eventPriceCount = existingEventPrices.length + 1;

        var newEventPrice = document.createElement('div');
        newEventPrice.className = 'event-price-item mt-4';

        // Incrementing label for event price
        var labelEventPrice = document.createElement('label');
        labelEventPrice.innerHTML = `<strong>Event Price ${eventPriceCount}</strong>`;
        newEventPrice.appendChild(labelEventPrice);

        newEventPrice.innerHTML += `
        <div class="mb-4">
            <label for="event_prices[${eventPriceCount - 1}][nama_variant]" class="block text-sm font-medium text-gray-600">Nama Variant</label>
            <input type="text" name="event_prices[${eventPriceCount - 1}][nama_variant]" class="mt-1 p-2 w-full border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="event_prices[${eventPriceCount - 1}][price]" class="block text-sm font-medium text-gray-600">Harga</label>
            <input type="number" name="event_prices[${eventPriceCount - 1}][price]" class="mt-1 p-2 w-full border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="event_prices[${eventPriceCount - 1}][max_visitor]" class="block text-sm font-medium text-gray-600">Max Pengunjung</label>
            <input type="number" name="event_prices[${eventPriceCount - 1}][max_visitor]" class="mt-1 p-2 w-full border rounded-md" required>
        </div>
    `;

        // Remove the existing "Add Event Price" button
        var existingAddEventPriceButton = eventPriceContainer.querySelector('.add-event-price');
        if (existingAddEventPriceButton) {
            existingAddEventPriceButton.remove();
        }

        // Add the new event price to the container
        eventPriceContainer.appendChild(newEventPrice);

        // Add a new "Add Event Price" button below the newly added event price
        var addEventPriceButton = document.createElement('button');
        addEventPriceButton.type = 'button';
        addEventPriceButton.className = 'btn btn-success btn-sm mt-2 add-event-price';
        addEventPriceButton.innerHTML = 'Add Event Price';
        addEventPriceButton.addEventListener('click', addEventPrice);

        eventPriceContainer.appendChild(addEventPriceButton);
        var presaleFormContainer = document.querySelector('.presale-form-container');
        var presaleForms = presaleFormContainer.querySelectorAll('.presale-form');
        var newPresaleForm = document.createElement('div');

        // Iterasi melalui nodelist dan tambahkan formulir ke setiap formulir
        presaleForms.forEach(function(presaleForm, index) {
            newPresaleForm.innerHTML = `
            <div class="mb-4">
                <input type="text" name="event_prices[${eventPriceCount - 1}][presales][${index}][variant]" class="form-control variant${index + 1}" hidden required>
            </div>

            <div class="mb-4">
                <input type="number" name="event_prices[${eventPriceCount - 1}][presales][${index}][discount]" class="form-control discount${index+1}" hidden required>
            </div>

            <div class="mb-4">
                <input type="datetime-local" name="event_prices[${eventPriceCount - 1}][presales][${index}][start_date]" class="form-control start${index+1}" hidden required>
            </div>

            <div class="mb-4">
                <input type="datetime-local" name="event_prices[${eventPriceCount - 1}][presales][${index}][due_to]" class="form-control due-to${index+1}" hidden required>
            </div>

            <div class="mb-4">
                <label for="event_prices[${eventPriceCount - 1}][presales][${index}][max_purchase]" class="block text-sm font-medium text-gray-600">
                    Maksimal Pembelian Event Price ${eventPriceCount} ${index+1}
                </label>
                <input type="number" name="event_prices[${eventPriceCount - 1}][presales][${index}][max_purchase]" class="form-control" required>
            </div>`;
            presaleForm.appendChild(newPresaleForm.cloneNode(true));
            fillInputValues(index);
        });
    }

    //         function addEventPrice() {
    //             var eventPriceContainer = document.querySelector('.event-price-container');
    //             var existingEventPrices = eventPriceContainer.querySelectorAll('.event-price-item');
    //             eventPriceCount = existingEventPrices.length + 1;

    //             var newEventPrice = document.createElement('div');
    //             newEventPrice.className = 'event-price-item mt-4';

    //             // Incrementing label for event price
    //             var labelEventPrice = document.createElement('label');
    //             labelEventPrice.innerHTML = `<strong>Event Price ${eventPriceCount}</strong>`;
    //             newEventPrice.appendChild(labelEventPrice);

    //             newEventPrice.innerHTML += `
    //         <br><label for="event_prices[${eventPriceCount - 1}][nama_variant]">Nama Variant</label>
    //         <input type="text" name="event_prices[${eventPriceCount - 1}][nama_variant]" class="form-control" required>

    //         <label for="event_prices[${eventPriceCount - 1}][price]">Harga</label>
    //         <input type="number" name="event_prices[${eventPriceCount - 1}][price]" class="form-control" required>

    //         <label for="event_prices[${eventPriceCount - 1}][max_visitor]">Max Pengunjung</label>
    //         <input type="number" name="event_prices[${eventPriceCount - 1}][max_visitor]" class="form-control" required>
    //     `;

    //             // Remove the existing "Add Event Price" button
    //             var existingAddEventPriceButton = eventPriceContainer.querySelector('.add-event-price');
    //             if (existingAddEventPriceButton) {
    //                 existingAddEventPriceButton.remove();
    //             }

    //             // Add the new event price to the container
    //             eventPriceContainer.appendChild(newEventPrice);

    //             // Add a new "Add Event Price" button below the newly added event price
    //             var addEventPriceButton = document.createElement('button');
    //             addEventPriceButton.type = 'button';
    //             addEventPriceButton.className = 'btn btn-success btn-sm mt-2 add-event-price';
    //             addEventPriceButton.innerHTML = 'Add Event Price';
    //             addEventPriceButton.addEventListener('click', addEventPrice);

    //             eventPriceContainer.appendChild(addEventPriceButton);
    //             var presaleFormContainer = document.querySelector('.presale-form-container');
    //             var presaleForms = presaleFormContainer.querySelectorAll('.presale-form');
    //             var newPresaleForm = document.createElement('div');

    //             // Iterasi melalui nodelist dan tambahkan formulir ke setiap formulir
    //             presaleForms.forEach(function(presaleForm, index) {
    //                 newPresaleForm.innerHTML = ` <input type="text" name="event_prices[${eventPriceCount - 1}][presales][${index}][variant]" class="form-control variant${index + 1}" hidden required>

    // <input type="number" name="event_prices[${eventPriceCount - 1}][presales][${index}][discount]" class="form-control discount${index+1}" hidden required>


    // <input type="datetime-local" name="event_prices[${eventPriceCount - 1}][presales][${index}][start_date]" class="form-control start${index+1}" hidden required>


    // <input type="datetime-local" name="event_prices[${eventPriceCount - 1}][presales][${index}][due_to]" class="form-control due-to${index+1}" hidden required>
    //     <label for="event_prices[${eventPriceCount - 1}][presales][${index}][max_purchase]">
    //         Maksimal Pembelian Event Price ${eventPriceCount} ${index+1}
    //     </label>
    //     <input type="number" name="event_prices[${eventPriceCount - 1}][presales][${index}][max_purchase]" class="form-control" required>
    // `;
    //                 presaleForm.appendChild(newPresaleForm.cloneNode(true));
    //                 fillInputValues(index);
    //             });

    //         }

    // Add an initial "Add Event Price" button
    document.addEventListener('DOMContentLoaded', function() {
        addEventPrice();

    });

    function proceedToPresaleForm() {

        var postFormData = JSON.parse(sessionStorage.getItem('postFormData')) || {};

        // Ambil data form event
        var eventFormData = {};
        var eventForm = document.getElementById('event-form');
        var eventFormElements = eventForm.elements;
        for (var i = 0; i < eventFormElements.length; i++) {
            var element = eventFormElements[i];
            if (element.name) {
                eventFormData[element.name] = element.value;
            }
        }

        // Append data form event ke data post yang sudah ada
        postFormData = {
            ...postFormData,
            ...eventFormData
        };
        sessionStorage.setItem('postFormData', JSON.stringify(postFormData));
        var formData = new FormData();

        // Append each key-value pair to FormData
        for (const [key, value] of Object.entries(postFormData)) {
            formData.append(key, value);
        }

        // Get photos data from sessionStorage
        var photosData = JSON.parse(sessionStorage.getItem('photos'));

        // Append each photo to FormData
        if (photosData && photosData.length > 0) {
            photosData.forEach((photo, index) => {
                const blob = base64ToBlob(photo.dataUrl);
                const file = new File([blob], photo.name, {
                    type: photo.type
                });
                formData.append(`photos[${index}]`, file);
            });
        }
        // Submit form dengan menggunakan fetch atau XHR
        fetch("{{ route('submit.post') }}", {
                method: 'POST',
                body: formData,
            })
            .then(() => {
                sessionStorage.removeItem('photos');
                sessionStorage.removeItem('postFormData');
                var dashboardRoute = "{{ route('dashboard') }}";
                window.location.href = dashboardRoute;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    // }

    function base64ToBlob(dataUrl) {
        const parts = dataUrl.split(';base64,');
        const contentType = parts[0].split(':')[1];
        const raw = window.atob(parts[1]);
        const uInt8Array = new Uint8Array(raw.length);

        for (let i = 0; i < raw.length; ++i) {
            uInt8Array[i] = raw.charCodeAt(i);
        }

        return new Blob([uInt8Array], {
            type: contentType
        });
    }

    function handleChange(changedInput) {
        // Dapatkan kelas dari input yang diubah
        var className = changedInput.className;

        // Dapatkan semua elemen input dengan kelas yang sama
        var inputs = document.getElementsByClassName(className);

        // Iterasi melalui elemen dan ubah nilai masing-masing
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = changedInput.value;
        }
    }

    function fillInputValues(index) {
        // Mendapatkan nilai dari elemen input berdasarkan id
        var sourceVariantValue = document.getElementById(`variant${index+1}`).value;
        var sourceDiscountValue = document.getElementById(`discount${index+1}`).value;
        var sourceStartDateValue = document.getElementById(`start${index+1}`).value;
        var sourceDueToValue = document.getElementById(`due-to${index+1}`).value;

        var targetVariants = document.querySelectorAll(`.variant${index + 1}`);
        var targetDiscounts = document.querySelectorAll(`.discount${index + 1}`);
        var targetStarts = document.querySelectorAll(`.start${index + 1}`);
        var targetDueTos = document.querySelectorAll(`.due-to${index + 1}`);

        // Mengisi nilai input yang baru di semua elemen dengan kelas yang sama
        targetVariants.forEach(function(element) {
            element.value = sourceVariantValue;
        });

        targetDiscounts.forEach(function(element) {
            element.value = sourceDiscountValue;
        });

        targetStarts.forEach(function(element) {
            element.value = sourceStartDateValue;
        });

        targetDueTos.forEach(function(element) {
            element.value = sourceDueToValue;
        });

    }
</script>
@endsection