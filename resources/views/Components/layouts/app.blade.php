<!DOCTYPE html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <title>{{ $title ?? 'Page Title' }}</title>

        <link rel="stylesheet" href="build/assets/app-Daf6CZA_.css ">
        <script src="build/assets/app-CMaRZiWJ.js"></script>
    </head>
    <body>
        <div class="container mx-auto">
            <x-header/>
            {{ $slot }}
        </div>
    </body>
</html>
