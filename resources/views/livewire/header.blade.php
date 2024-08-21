<nav class="border-b border-gray-200  py-2.5 ">
    <div class="flex flex-wrap justify-between items-center mx-auto ">

        <a href="{{route('home')}}" wire:navigate class="flex items-center">
            <img src="{{asset('images/icons8-task-96.png')}}" class="ml-3 h-14 rounded-lg" alt="Flowbite Logo" />
            <span class=" text-xl font-semibold whitespace-nowrap ">سیستم مدیریت وظایف</span>
        </a>

        <div class="flex items-center lg:order-2">
            @auth
            <a href="{{route('dashboard')}}" wire:navigate class="hover:text-gray-800  duration-200  hover:bg-gray-50 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2  border">{{auth()->user()->name}}</a>
            @else
            <a href="{{route('login')}}" wire:navigate class="hover:text-gray-800  duration-200  hover:bg-gray-50 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2  border">ورود به حساب</a>
            @endauth

            <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200   " aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        
    </div>
</nav>

<script>
   



    document.addEventListener('DOMContentLoaded', function() {
    
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "rtl" : true
        };
    
        Echo.channel('high-task')
            .listen('TaskProcessed', function(event) {
                toastr.success('وظیفه ای با اولویت بالا ایجاد شد.', event.task.title);
            });
    
        Echo.channel('task-completed')
            .listen('TaskCompleted', function(event) {
                toastr.success(`وظیفه ${event.task.title} کامل شده است`, event.task.title);
            });
    });
    
    
    </script>
