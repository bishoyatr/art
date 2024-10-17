<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Art')</title>
    <!-- Add your CSS and meta tags here -->
</head>
<body>
     @include('inc.navbar')
    
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
     @include('inc.footer')
   
    @stack('scripts')
</body>
</html>
