<div>
    <section class="mt-6 border rounded-lg p-4 lg:p-6">

        @if (session()->has('error'))
        <div class="bg-red-200 text-red-600 rounded-lg p-3 my-3">
            {{ session('error') }}
        </div>
        @endif

        @if (session()->has('success'))
        <div class="bg-emerald-200 text-emerald-600 rounded-lg p-3 my-3">
            {{ session('success') }}
        </div>
        @endif

        <button wire:click="logout" class="bg-red-400 rounded-lg px-3 py-1 text-white mb-6 mt-3">
            خروج کاربر
        </button>

        <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-950 ">
                    وظایف
                </h1>
            </div>
        
            
            <livewire:tasks.form />

        </header>
        
        <div class="mt-16">
            <div class="grid grid-cols-7  mt-8 text-gray-700 font-bold py-3">
                <span class="col-span-2">عنوان وظیفه</span>
                <span>تاریخ پایان</span>
                <span>اولویت</span>
                <span>وضعیت</span>
                <span>عملیات</span>
                <span class="text-center">تغییر وضعیت</span>
            </div>
    
            @foreach ($tasks as $task)
            <div x-data="{ open: false }" class="grid grid-cols-7 px-3 py-6 mt-4 border rounded-lg">
                <span @click="open = !open" class="col-span-2 cursor-pointer">{{$task['title']}}</span>
                <span>{{$task['expiration_date']}}</span>
                <span>{{$task['priority']}}</span>
                <span>{{$task['status']}}</span>
                <div class="flex gap-x-6 items-center">
                    <a href="{{route('showTask', $task['id'])}}" wire:navigate>
                        <svg class="h-6 w-6 fill-primary-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                    </a>
                    <button wire:click="removeTask({{$task['id']}})" type="button" >
                        <svg class="h-4 w-4 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                    </button>
                </div>
                <div x-data="{ dropDown: false }" class="relative text-center">
                    <button @click="dropDown = !dropDown" type="button" class="  bg-gray-200 hover:bg-gray-300  focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5  ">تغییر وضعیت</button>
                    <div x-show="dropDown" x-transition x-cloak class="border bg-white my-shadow z-10 rounded-lg p-3 absolute w-full grid gap-y-3">
                        <button @click="$wire.updateStatus({{$task['id']}}, 'in_progress');dropDown=false"  type="button" class="border rounded-lg p-2">در حال انجام</button>
                        <button @click="$wire.updateStatus({{$task['id']}}, 'completed');dropDown=false" type="button"  class="border rounded-lg p-2">کامل شده</button>
                        <button @click="$wire.updateStatus({{$task['id']}}, 'deferred');dropDown=false" type="button"  class="border rounded-lg p-2">به تعویق افتاده</button>
                    </div>
                </div>

                <div x-show="open" x-transition x-cloak class="col-span-full bg-primary-600 bg-opacity-10 p-4 mt-8 rounded-lg text-primary-900">
                    <p>توضیحات : {{$task['description']}}</p>
                </div>
            </div>
            @endforeach
            
        </div>
    </section>

</div>
