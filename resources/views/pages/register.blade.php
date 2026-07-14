<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Register | Onyx Business Control System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --bg: #050506;
            --panel: #0a0a0c;
            --line: rgba(255,255,255,.1);
            --line-strong: rgba(255,255,255,.22);
            --text: #fff;
            --muted: #858590;
            --soft: #d8d8de;
            --danger: #ffaaaa;
        }

        * { box-sizing: border-box; }
        html, body { min-height: 100%; }

        body {
            align-items: center;
            background:
                linear-gradient(rgba(255,255,255,.032) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.032) 1px, transparent 1px),
                radial-gradient(circle at 50% 18%, rgba(255,255,255,.08), transparent 28%),
                var(--bg);
            background-size: 40px 40px, 40px 40px, auto, auto;
            color: var(--text);
            display: flex;
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            justify-content: center;
            margin: 0;
            padding: 28px;
        }

        .auth-shell {
            align-items: center;
            display: flex;
            justify-content: center;
            min-height: calc(100vh - 56px);
            position: relative;
            width: 100%;
        }

        .back-link {
            align-items: center;
            background: rgba(0,0,0,.34);
            border: 1px solid var(--line);
            color: var(--soft);
            display: inline-flex;
            font-size: 12px;
            font-weight: 900;
            gap: 8px;
            left: 0;
            min-height: 36px;
            padding: 0 12px;
            position: absolute;
            text-decoration: none;
            top: 0;
        }

        .back-link:hover {
            background: #fff;
            color: #050506;
        }

        .register-frame {
            background: transparent;
            border: 1px solid var(--line-strong);
            box-shadow: 0 34px 90px rgba(0,0,0,.55);
            display: grid;
            grid-template-columns: minmax(280px, .88fr) minmax(390px, 1.12fr);
            min-height: 620px;
            overflow: hidden;
            position: relative;
            width: min(980px, 100%);
        }

        .register-frame::before {
            border: 1px solid rgba(255,255,255,.055);
            content: "";
            inset: 10px;
            pointer-events: none;
            position: absolute;
            z-index: 2;
        }

        .brand-side {
            align-items: center;
            background:
                linear-gradient(145deg, rgba(255,255,255,.08), transparent 38%),
                #09090b;
            border-right: 1px solid var(--line);
            display: flex;
            justify-content: center;
            padding: 30px;
            position: relative;
        }

        .brand-mark {
            align-items: center;
            background: #fff;
            display: flex;
            height: 150px;
            justify-content: center;
            padding: 16px;
            position: relative;
            width: 150px;
            z-index: 3;
        }

        .brand-mark img {
            display: block;
            height: 100%;
            object-fit: contain;
            width: 100%;
        }

        .form-side {
            align-content: center;
            background:
                linear-gradient(180deg, rgba(255,255,255,.035), transparent 34%),
                var(--panel);
            display: grid;
            padding: 42px;
            position: relative;
        }

        .register-card {
            margin: 0 auto;
            max-width: 440px;
            position: relative;
            width: 100%;
            z-index: 3;
        }

        .eyebrow {
            align-items: center;
            color: var(--muted);
            display: flex;
            font-size: 11px;
            font-weight: 900;
            gap: 8px;
            margin-bottom: 16px;
            text-transform: uppercase;
        }

        .eyebrow::before {
            background: #fff;
            content: "";
            height: 1px;
            width: 34px;
        }

        .title {
            font-size: 28px;
            font-weight: 900;
            line-height: 1.08;
            margin: 0 0 9px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.55;
            margin: 0 0 24px;
        }

        .register-form {
            display: grid;
            gap: 13px;
        }

        .error-box {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,170,170,.5);
            color: var(--danger);
            font-size: 12px;
            font-weight: 800;
            line-height: 1.5;
            padding: 11px 12px;
        }

        .field-grid {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .field-group {
            display: grid;
            gap: 7px;
        }

        .field-group.full {
            grid-column: 1 / -1;
        }

        .field-group label {
            color: var(--soft);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .input-wrap {
            align-items: center;
            background: #050506;
            border: 1px solid var(--line);
            display: grid;
            gap: 11px;
            grid-template-columns: 18px 1fr;
            min-height: 44px;
            padding: 0 12px;
        }

        .input-wrap i {
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        .input-wrap:focus-within {
            border-color: #fff;
            box-shadow: 0 0 0 3px rgba(255,255,255,.08);
        }

        .input {
            background: transparent;
            border: 0;
            color: #fff;
            font: inherit;
            font-size: 13px;
            font-weight: 700;
            height: 42px;
            min-width: 0;
            outline: 0;
            padding: 0;
            width: 100%;
        }

        .input::placeholder {
            color: rgba(255,255,255,.24);
        }

        .field-error {
            color: var(--danger);
            font-size: 11px;
            font-weight: 800;
            line-height: 1.4;
        }

        .password-note {
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            line-height: 1.45;
        }

        .primary-button {
            align-items: center;
            background: #fff;
            border: 1px solid #fff;
            color: #050506;
            cursor: pointer;
            display: inline-flex;
            font: inherit;
            font-size: 12px;
            font-weight: 900;
            gap: 9px;
            height: 46px;
            justify-content: center;
            margin-top: 5px;
            text-transform: uppercase;
            width: 100%;
        }

        .primary-button:hover {
            background: transparent;
            color: #fff;
        }

        .register-foot {
            align-items: center;
            border-top: 1px solid var(--line);
            display: flex;
            gap: 12px;
            justify-content: space-between;
            margin-top: 24px;
            padding-top: 16px;
        }

        .register-foot span {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        .register-foot a {
            border: 1px solid var(--line);
            color: #fff;
            font-size: 11px;
            font-weight: 900;
            min-height: 34px;
            padding: 9px 11px;
            text-decoration: none;
            text-transform: uppercase;
        }

        .register-foot a:hover {
            background: #fff;
            color: #050506;
        }

        @media (max-width: 860px) {
            body { padding: 16px; }
            .auth-shell {
                align-items: flex-start;
                min-height: calc(100vh - 32px);
                padding-top: 54px;
            }
            .register-frame {
                grid-template-columns: 1fr;
                min-height: auto;
            }
            .brand-side {
                border-bottom: 1px solid var(--line);
                border-right: 0;
                padding: 24px;
            }
            .form-side { padding: 28px 22px; }
        }

        @media (max-width: 560px) {
            .field-grid { grid-template-columns: 1fr; }
            .title { font-size: 24px; }
            .register-foot {
                align-items: stretch;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <main class="auth-shell" aria-labelledby="register-title">
        <a class="back-link" href="{{ route('login') }}"><i class="fa-solid fa-arrow-left"></i> Sign In</a>

        <section class="register-frame">
            <aside class="brand-side" aria-label="Onyx logo">
                <div class="brand-mark" aria-label="Onyx Business Control System">
                    <img src="{{ asset('assets/onxy logo.jpeg') }}" alt="">
                </div>
            </aside>

            <section class="form-side">
                <div class="register-card">
                    <div class="eyebrow">Workspace registration</div>
                    <h1 class="title" id="register-title">Create an admin workspace</h1>
                    <p class="subtitle">Your account will be created as the workspace administrator.</p>

                    <form class="register-form" method="POST" action="{{ route('register') }}">
                        @csrf

                        @if($errors->any())
                            <div class="error-box">{{ $errors->first() }}</div>
                        @endif

                        <div class="field-grid">
                            <div class="field-group full">
                                <label for="company_name">Company Name</label>
                                <div class="input-wrap">
                                    <i class="fa-solid fa-building"></i>
                                    <input id="company_name" name="company_name" type="text" class="input" value="{{ old('company_name') }}" placeholder="Onyx Technologies" autocomplete="organization" required autofocus>
                                </div>
                                @error('company_name')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="field-group">
                                <label for="name">Admin Name</label>
                                <div class="input-wrap">
                                    <i class="fa-solid fa-user-shield"></i>
                                    <input id="name" name="name" type="text" class="input" value="{{ old('name') }}" placeholder="Admin User" autocomplete="name" required>
                                </div>
                                @error('name')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="field-group">
                                <label for="email">Admin Email</label>
                                <div class="input-wrap">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input id="email" name="email" type="email" class="input" value="{{ old('email') }}" placeholder="admin@company.com" autocomplete="email" required>
                                </div>
                                @error('email')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="field-group">
                                <label for="password">Password</label>
                                <div class="input-wrap">
                                    <i class="fa-solid fa-lock"></i>
                                    <input id="password" name="password" type="password" class="input" placeholder="Create password" autocomplete="new-password" required>
                                </div>
                                @error('password')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="field-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-wrap">
                                    <i class="fa-solid fa-key"></i>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="input" placeholder="Confirm password" autocomplete="new-password" required>
                                </div>
                            </div>
                        </div>

                        <div class="password-note">Use at least 10 characters with uppercase, lowercase, number, and symbol.</div>

                        <button class="primary-button" type="submit">
                            <i class="fa-solid fa-user-plus"></i>
                            Create Account
                        </button>
                    </form>

                    <footer class="register-foot">
                        <span>Already registered?</span>
                        <a href="{{ route('login') }}">Sign In</a>
                    </footer>
                </div>
            </section>
        </section>
    </main>
</body>
</html>
