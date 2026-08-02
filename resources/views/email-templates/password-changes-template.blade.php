<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mot de passe modifié</title>
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
            color: #111827;
        }

        .email-wrapper {
            max-width: 560px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e4e4e7;
        }

        /* Header */
        .email-header {
            background: #1a1a2e;
            padding: 1.75rem 2.5rem;
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

        /* Body */
        .email-body {
            padding: 2.25rem 2.5rem 1.75rem;
        }

        .icon-circle {
            width: 56px;
            height: 56px;
            background: #EAF3DE;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-circle svg {
            width: 26px;
            height: 26px;
        }

        .email-body h1 {
            font-size: 22px;
            font-weight: 600;
            color: #111827;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .email-body .sub {
            font-size: 14px;
            color: #6b7280;
            text-align: center;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        /* Timestamp */
        .timestamp {
            font-size: 12px;
            color: #9ca3af;
            text-align: center;
            margin-bottom: 1.25rem;
        }

        /* Credentials box */
        .creds {
            background: #f9fafb;
            border: 1px solid #e4e4e7;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        .creds-title {
            font-size: 11px;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 0.75rem;
        }

        .cred-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #e4e4e7;
        }

        .cred-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .cred-icon {
            width: 16px;
            flex-shrink: 0;
            color: #9ca3af;
        }

        .cred-label {
            font-size: 12px;
            color: #9ca3af;
            min-width: 80px;
        }

        .cred-value {
            font-size: 13px;
            color: #111827;
            font-family: 'Courier New', monospace;
            word-break: break-all;
        }

        /* Warning box */
        .warning-box {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            background: #FCEBEB;
            border: 1px solid #F09595;
            border-radius: 8px;
            padding: 0.875rem 1rem;
            margin-bottom: 1.5rem;
        }

        .warning-icon {
            width: 16px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .warning-box p {
            font-size: 13px;
            color: #791F1F;
            line-height: 1.6;
            text-align: left;
            margin: 0;
        }

        /* CTA */
        .btn-wrap {
            text-align: center;
            margin: 1.25rem 0 0.5rem;
        }

        .btn-secure {
            display: inline-block;
            background: #534AB7;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 8px;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid #e4e4e7;
            margin: 1.5rem 0;
        }

        .security-note {
            font-size: 12px;
            color: #9ca3af;
            text-align: center;
            line-height: 1.6;
        }

        /* Footer */
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

        /* Responsive */
        @media (max-width: 600px) {

            .email-body,
            .email-footer {
                padding: 1.75rem 1.25rem;
            }

            .email-header {
                padding: 1.5rem 1.25rem;
            }

            .email-body h1 {
                font-size: 18px;
            }

            .cred-row {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

    <div class="email-wrapper">

        <!-- Header -->
        <div class="email-header">
            <div class="logo">Digital <span> Akili-Group</span></div>
        </div>

        <!-- Body -->
        <div class="email-body">

            <!-- Icon -->
            <div class="icon-circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#3B6D11"
                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>

            <h1>Mot de passe mis à jour avec succès</h1>
            <p class="sub">
                Le mot de passe de votre compte a été modifié. Vous trouverez ci-dessous vos nouveaux identifiants de
                connexion.

                Conservez-les précieusement et ne les communiquez à personne.
            </p>

            <!-- Timestamp -->
            <p class="timestamp">⏱ Modifié le {{ $changed_at }}</p>

            <!-- Credentials -->
            <div class="creds">
                <p class="creds-title">Vos identifiants de connexion</p>

                <div class="cred-row">
                    <svg class="cred-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="cred-label">Username</span>
                    <span class="cred-value">{{ $user->username }}</span>
                </div>

                <div class="cred-row">
                    <svg class="cred-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="cred-label">Email</span>
                    <span class="cred-value">{{ $user->email }}</span>
                </div>

                <div class="cred-row">
                    <svg class="cred-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span class="cred-label">Nouveau Mot de passe</span>
                    <span class="cred-value">{{ $new_password }}</span>
                </div>
            </div>

            <!-- Warning -->
            {{-- <div class="warning-box">
        <svg class="warning-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
          stroke="#A32D2D" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round"
          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <p>If you did not make this change, your account may be compromised. Secure it immediately by clicking the button below.</p>
      </div> --}}

            <!-- CTA -->
            {{-- <div class="btn-wrap">
        <a href="{{ $secureUrl }}" class="btn-secure">Secure my account</a>
      </div> --}}

            {{-- <hr class="divider">

      <p class="security-note">
        For security reasons, we never send your password in plain text.<br>
        If you need to recover access, use the forgot password flow.
      </p> --}}
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Ce courriel a été envoyé à <strong>{{ $user->email }}</strong></p>
            <p>© {{ date('Y') }} Ditital Akili-group &nbsp;·&nbsp; <a href="#">Privacy Policy</a>
                &nbsp;·&nbsp; <a href="#">Support</a></p>
        </div>

    </div>

</body>

</html>
