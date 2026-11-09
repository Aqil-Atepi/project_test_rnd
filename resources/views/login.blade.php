<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
</head>
<body>
    <h1>Login</h1>

    <form method="POST" action="{{ route('login.attempt') }}">
        @csrf

        @error('username')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <label for="username">Username</label>
        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <a href="{{ route('home') }}">Kembali ke halaman utama</a>
</body>
</html>