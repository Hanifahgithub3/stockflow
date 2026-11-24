<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - StockFlow</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
<body class="bg-light">
<div class="container" style="max-width: 400px; margin-top: 12vh;">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h4 class="mb-1">StockFlow</h4>
            <p class="text-muted mb-4">Masuk untuk melanjutkan</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>