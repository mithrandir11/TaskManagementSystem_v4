<div>
    @if (session()->has('error'))
        <div class="bg-red-200 text-red-600 rounded-lg p-3 my-3">
            {{ session('error') }}
        </div>
    @endif
    <div x-data="{ showModal: false }">
        <button @click="showModal = !showModal" type="button" class="w-full text-white bg-primary-600 hover:bg-primary-700  focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5  ">وظیفه جدید +</button>
        
        <div x-show="showModal" x-cloak class=" bg-black bg-opacity-20 flex fixed top-0 right-0 left-0 z-40 w-full h-full"></div>
        {{-- modal create task --}}
        <div x-show="showModal" x-transition x-cloak tabindex="-1" aria-hidden="true" class=" overflow-y-auto overflow-x-hidden flex fixed top-0 right-0 left-0 z-50 justify-center pt-8 w-full md:inset-0  max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5  rounded-t ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            ساخت وظیفه
                        </h3>
                        <button @click="showModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form wire:submit.prevent="store" class="p-4 md:p-5 mt-5  space-y-6">
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">عنوان</label>
                            <input wire:model="title" type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"   />
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">توضیحات</label>
                            <textarea wire:model="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500  " ></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    
                        <div>
                            <label for="expiration_date" class="block mb-2 text-sm font-medium text-gray-900 ">تاریخ پایان</label>
                            <input wire:model="expiration_date" data-jdp autocomplete="off" type="text" id="expiration_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"   />
                            @error('expiration_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    
                        <div>
                            <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 ">اولویت</label>
                            <select wire:model="priority" id="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                                <option value="high">بالا</option>
                                <option value="medium">متوسط</option>
                                <option value="low">پایین</option>
                            </select>
                            @error('priority') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 ">وضعیت</label>
                            <select wire:model="status" id="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                                <option value="in_progress">در حال انجام</option>
                                <option value="completed">کامل شده</option>
                                <option value="deferred">به تعویق افتاده</option>
                            </select>
                            @error('priority') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                
                        <div class="flex justify-center items-center p-4 md:p-5  border-gray-200  ">
                            <button  type="submit" class="text-white bg-primary-700 hover:bg-primary-800  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center ">ذخیره</button>
                            <button @click="showModal = false"  type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 0  ">انصراف</button>
                        </div>
                    </form>
                    
           

                </div>
            </div>
        </div>
    </div>

    @script
        <script>
            jalaliDatepicker.startWatch({
                minDate: 'today'
            });
        </script>
    @endscript
</div>






