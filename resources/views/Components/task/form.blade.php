<form class="max-w-md mx-auto mt-5 border rounded-lg p-8 space-y-6">
    <div>
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">عنوان</label>
      <input type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"  required />
    </div>

    <div>
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">توضیحات</label>
      <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500  " ></textarea>
    </div>

    <div>
        <label for="expiration_date" class="block mb-2 text-sm font-medium text-gray-900 ">تاریخ پایان</label>
        <input data-jdp type="text" id="expiration_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"  required />
    </div>

    <div>
        <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 ">اولویت</label>
        <select id="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
            <option>بالا</option>
            <option>متوسط</option>
            <option>پایین</option>
        </select>
    </div>

   <div>
        <button type="submit" class="text-white bg-primary-700 duration-200 hover:bg-primary-800 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mx-auto block">ذخیره</button>
   </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        jalaliDatepicker.startWatch({
            minDate: 'today'
        });
    });
</script>
  