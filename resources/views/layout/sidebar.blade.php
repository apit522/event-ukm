<div class="flex bg-gray-100 text-gray-900" style="z-index: 100;">
    <aside class="flex h-screen w-20 flex-col items-center border-r border-gray-200 bg-white">
        <a href="/" class="flex h-[4.5rem] w-full items-center justify-center border-b border-gray-200 p-2">
            <img src={{ asset('images/logo.png') }}>
        </a>
        <nav class="flex flex-1 flex-col gap-y-4 pt-10">
            <a href="/dashboard" class="group relative rounded-xl bg-gray-100 p-2 text-blue-600 hover:bg-gray-50">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                <div class="absolute inset-y-0 left-12 hidden items-center group-hover:flex">
                    <div class="relative whitespace-nowrap rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 drop-shadow-lg">
                        <div class="absolute inset-0 -left-1 flex items-center">
                            <div class="h-2 w-2 rotate-45 bg-white"></div>
                        </div>
                        Dashboard<span class="text-gray-400"></span>
                    </div>
                </div>
            </a>

            <a href="/dashboard/post" class="text-gary-400 group relative rounded-xl p-2 hover:bg-gray-50">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6M9 8h6m-6 3h6M4.996 5h.01m-.01 3h.01m-.01 3h.01M2 1h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                </svg>

                <div class="absolute inset-y-0 left-12 hidden items-center group-hover:flex">
                    <div class="relative whitespace-nowrap rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 drop-shadow-lg">
                        <div class="absolute inset-0 -left-1 flex items-center">
                            <div class="h-2 w-2 rotate-45 bg-white"></div>
                        </div>
                        Postingan<span class="text-gray-400"></span>
                    </div>
                </div>
            </a>
        </nav>
        <div class="flex flex-col items-center gap-y-4 py-10">

            <a href="/dashboard/profile" class="mt-2 rounded-full bg-gray-100">
                <img class="h-10 w-10 rounded-full" src="{{ auth('ukm')->user()->profile_picture }}" alt="Profile Picture" />

            </a>
        </div>

    </aside>
</div>