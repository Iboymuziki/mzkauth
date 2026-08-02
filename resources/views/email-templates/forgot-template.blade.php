<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Your Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f4f7;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding: 2rem 1rem;
        }

        .email-wrapper {
            max-width: 560px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e4e4e7;
        }

        /* ── Header ── */
        .email-header {
            background: #1a1a2e;
            padding: 2rem 2.5rem 1.5rem;
            text-align: center;
        }

        .email-header .logo {
            font-size: 20px;
            font-weight: 600;
            color: #e8e4ff;
            letter-spacing: 0.04em;
        }

        .email-header .logo span {
            color: #a99ff5;
        }

        /* ── Body ── */
        .email-body {
            padding: 2.5rem 2.5rem 2rem;
        }

        .icon-wrap {
            width: 56px;
            height: 56px;
            background: #eeedfe;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-wrap svg {
            width: 26px;
            height: 26px;
            color: #534ab7;
        }

        .email-body h1 {
            font-size: 22px;
            font-weight: 600;
            color: #111827;
            text-align: center;
            margin-bottom: 0.75rem;
        }

        .email-body p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.7;
            text-align: center;
            margin-bottom: 1.25rem;
        }

        /* ── CTA Button ── */
        .btn-wrap {
            text-align: center;
            margin: 1.75rem 0 1.25rem;
        }

        .btn-reset {
            display: inline-block;
            background: #534ab7;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 13px 36px;
            border-radius: 8px;
        }

        /* ── Expiry note ── */
        .expiry-note {
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 1.5rem;
        }

        /* ── Divider ── */
        .divider {
            border: none;
            border-top: 1px solid #e4e4e7;
            margin: 1.5rem 0;
        }

        /* ── Fallback link box ── */
        .link-fallback {
            background: #f9fafb;
            border: 1px solid #e4e4e7;
            border-radius: 8px;
            padding: 0.875rem 1rem;
        }

        .link-fallback p {
            font-size: 12px;
            color: #9ca3af;
            text-align: left;
            margin-bottom: 6px;
        }

        .link-fallback code {
            font-size: 11.5px;
            font-family: 'Courier New', monospace;
            color: #534ab7;
            word-break: break-all;
            display: block;
        }

        /* ── Footer ── */
        .email-footer {
            border-top: 1px solid #e4e4e7;
            padding: 1.25rem 2.5rem;
            text-align: center;
        }

        .email-footer p {
            font-size: 12px;
            color: #9ca3af;
            line-height: 1.6;
            margin-bottom: 4px;
        }

        .email-footer a {
            color: #9ca3af;
            text-decoration: underline;
        }

        /* ── Responsive ── */
        @media (max-width: 600px) {

            .email-body,
            .email-footer {
                padding: 2rem 1.25rem;
            }

            .email-header {
                padding: 1.5rem 1.25rem;
            }

            .email-body h1 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="email-wrapper">

        <!-- Header -->
        <div class="email-header">
            <div class="logo">Ditital <span> Akili-Group</span></div>
            <img src="/back/mzk/static/akili_logo.png" alt="" srcset="">
        </div>

        <!-- Body -->
        <div class="email-body">

            <!-- Lock icon -->
            <div class="icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.8" color="#534ab7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 11V7a4 4 0 00-8 0v4M5 11h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2z" />
                </svg>
            </div>

            <h1>Réinitialisez votre mot de passe</h1>
            <p>
                Bonjour <strong> {{ $user->name }} </strong> ,
                Nous avons reçu une demande de réinitialisation du mot de passe de votre compte.

                Cliquez sur le bouton ci-dessous pour choisir un nouveau mot de passe.

                Si vous n'avez pas fait cette demande, vous pouvez ignorer ce courriel.
            </p>

            <!-- CTA -->
            <div class="btn-wrap">
                <a href="{{ $actionlink }}" class="btn-reset">Cliquez Ici Pour Rénitialiser</a>
            </div>

            <p class="expiry-note">⏱ Ce lien expire dans 15 Min.</p>

        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>This email was sent to <strong>{{ $user->name }}</strong></p>
            <p>If you didn't request a password reset, no action is needed.<br>
                Your password won't change until you click the link above.</p>
            <p style="margin-top: 12px;">
                © {{ date('Y') }} Akili-Group &nbsp;·&nbsp;
                <a href="#">Unsubscribe</a> &nbsp;·&nbsp;
                <a href="#">Privacy Policy</a>
            </p>
        </div>
    </div>

</body>

</html>
