<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .register-container {
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .register-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .register-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .register-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .register-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
        <form method="POST" action="/register">
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: red; font-size: 12px;">{{ $message }}</div>
            @enderror
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email')
                <div style="color: red; font-size: 12px;">{{ $message }}</div>
            @enderror
            <input type="password" name="password" placeholder="Password" required>
            @error('password')
                <div style="color: red; font-size: 12px;">{{ $message }}</div>
            @enderror
            <input type="password" name="password_confirmation" placeholder="Confirm password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have account? <a href="/">Login</a></p>
        @if ($errors->any())
            <div style="color: red; text-align: center;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
