<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome!</h1>
    
    @auth
        <p>Welkom {{ Auth::user()->name }}</p>
        <a href="{{ url('/admin') }}">Naar Admin Panel</a>
    @else
        <p><a href="{{ route('filament.admin.auth.login') }}">Login</a></p>
    @endauth
</body>
</html>