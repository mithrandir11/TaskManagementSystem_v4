<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto  lg:py-0 mt-16">
    
    <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0 ">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl text-center">
                ورود به حساب
            </h1>
            <form wire:submit.prevent="login" class="space-y-4 md:space-y-6">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">ایمیل</label>
                    <input wire:model="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="name@company.com" >
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">گذرواژه</label>
                    <input wire:model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " >
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">ورود به حساب</button>
                <p class="text-sm font-light text-gray-500 ">
                    اگر در سایت عضو نشده اید! همین الان <a href="{{route('register')}}" wire:navigate class="font-medium text-primary-600 hover:underline ">ثبت نام</a> کنید
                </p>
            </form>
        </div>
    </div>
</div>
   

