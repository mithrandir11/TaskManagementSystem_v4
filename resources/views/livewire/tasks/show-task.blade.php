<div>

    @if (session()->has('error'))
        <div class="bg-red-200 text-red-600 rounded-lg p-3 my-3">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="p-4 md:p-5 space-y-6 sm:max-w-xl mx-auto mt-8">
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
                <option value="بالا">بالا</option>
                <option value="متوسط">متوسط</option>
                <option value="پایین">پایین</option>
            </select>
            @error('priority') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 ">وضعیت</label>
            <select wire:model="status" id="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                <option value='در حال انجام'>در حال انجام</option>
                <option value='کامل شده'>کامل شده</option>
                <option value='به تعویق افتاده'>به تعویق افتاده</option>
            </select>
            @error('priority') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-center items-center p-4 md:p-5  border-gray-200  ">
            <button  type="submit" class="text-white bg-primary-700 hover:bg-primary-800  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center ">ذخیره</button>
        </div>
    </form>

    @script
        <script>
            jalaliDatepicker.startWatch({
                minDate: 'today'
            });
        </script>
    @endscript
</div>
