<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form method="POST" action="{{ route('log') }}">
        @csrf

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" required>
        @error('username')
        <p class="text-red-500">{{ $message }}</p>
        @enderror

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        @error('password')
        <p class="text-red-500">{{ $message }}</p>
        @enderror

        <button type="submit">Login</button>
    </form>
</body>
</html>
