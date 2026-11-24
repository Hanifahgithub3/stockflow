
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - StockFlow</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --green: #234b3c;
            --green-dark: #19382d;
            --sage: #dfe9e1;
            --cream: #f6f7f3;
            --text: #26352e;
            --muted: #7c8981;
        }

        body {
            background: var(--cream);
            min-height: 100vh;
            font-family: "Segoe UI", sans-serif;
            color: var(--text);
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .login-container {
            width: 100%;
            max-width: 1000px;
            min-height: 560px;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(35, 75, 60, 0.08);
            display: flex;
        }

        /* LEFT SIDE */
        .login-brand {
            width: 50%;
            background: var(--green);
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .brand-logo {
            font-size: 23px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .brand-logo span {
            color: #b9d1bf;
        }

        .brand-content {
            z-index: 2;
        }

        .brand-content h1 {
            font-size: 42px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .brand-content p {
            color: #d0ddd4;
            font-size: 15px;
            line-height: 1.8;
            max-width: 340px;
        }

        .brand-footer {
            color: #b9cec1;
            font-size: 12px;
            z-index: 2;
        }

        .decor-circle {
            position: absolute;
            width: 300px;
            height: 300px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 50%;
            right: -100px;
            top: 100px;
        }

        .decor-circle::before {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 50%;
            top: 40px;
            left: 40px;
        }

        /* RIGHT SIDE */
        .login-form-section {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
        }

        .login-form-content {
            width: 100%;
            max-width: 360px;
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            min-height: 48px;
            border: 1px solid #e2e8e3;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(35, 75, 60, 0.10);
        }

        .login-btn {
            min-height: 48px;
            border-radius: 10px;
            background: var(--green);
            color: white;
            font-weight: 600;
            border: none;
            transition: 0.2s;
        }

        .login-btn:hover {
            background: var(--green-dark);
            color: white;
            transform: translateY(-1px);
        }

        .login-footer {
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            margin-top: 35px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .login-wrapper {
                padding: 16px;
            }

            .login-container {
                min-height: auto;
                max-width: 450px;
            }

            .login-brand {
                display: none;
            }

            .login-form-section {
                width: 100%;
                padding: 35px 25px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">
    <div class="login-container">

        <!-- BRANDING -->
        <div class="login-brand">
            <div class="brand-logo">
                Stock<span>Flow</span>
            </div>

            <div class="brand-content">
                <h1>Manage stock.<br>Work smarter.</h1>
                <p>
                    A simpler way to manage products,
                    monitor inventory, and keep your
                    business operations organized.
                </p>
            </div>

            <div class="brand-footer">
                Inventory Management System &copy; {{ date('Y') }}
            </div>

            <div class="decor-circle"></div>
        </div>

        <!-- LOGIN FORM -->
        <div class="login-form-section">
            <div class="login-form-content">

                <h2 class="login-title">Welcome back</h2>
                <p class="login-subtitle">
                    Masuk ke akun Anda untuk melanjutkan.
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="nama@email.com"
                            required
                            autofocus
                        >

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            required
                        >
                    </div>

                    <button type="submit" class="btn login-btn w-100">
                        Login to StockFlow
                    </button>
                </form>

                <div class="login-footer">
                    Secure access to your inventory system
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>
