<div>


    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button wire:click="changeTab(2)" class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                    data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                    aria-selected="true">Konfirmasi</button>
            </li>
            <li class="me-2" role="presentation">
                <button wire:click="changeTab(1)"
                    class="inline-block p-4 border-b-2 rounded-t-lg  hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">Selesai</button>
            </li>
        </ul>
    </div>



    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        End
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Kode
                    </th>
                    <th scope="col" class="px-6 py-3">
                        status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($invoice as $post)
                    @if ($post->status == $statusCode)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($post->detail['end'])->format('d M Y H:i:s') }}
                            </td>


                            <td class="px-6 py-4">
                                {{ $post->nama_pemilik }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->detail['email'] }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $post->last_three_value }}
                            </td>
                            <td class="px-6 py-4 ">
                                @if ($post->status == 1)
                                    <span class="text-green-600 font-bold">Paid</span>
                                @elseif($post->status == 2)
                                    <span class="text-red-600 font-bold">Unpaid</span>
                                @elseif($post->status == 3)
                                    <span class="text-yellow-600">Need Confirmation</span>
                                @else
                                    <span class="text-gray-600">Unknown</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ 'Rp ' . number_format($post->price, 0, ',', '.') }}
                            </td>
                            @if ($post->status == 2)
                                <td class="px-6 py-4">
                                    <button type="button" wire:click="approve({{ $post->id }})"
                                        class="text-white bg-green-700 hover:bg-green-800  font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Approve</button>
                                </td>
                            @else
                                <td class="px-6 py-4">
                                    <button type="button" wire:click="approve({{ $post->id }})"
                                        class="text-white font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 ">Approve</button>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>


</div>
