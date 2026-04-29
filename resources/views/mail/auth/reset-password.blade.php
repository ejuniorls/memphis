<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de senha</title>
</head>
<body
    style="margin:0;padding:0;background-color:#f0f0f0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f0f0;padding:40px 16px;">
    <tr>
        <td align="center">

            {{-- Card --}}
            <table width="100%" cellpadding="0" cellspacing="0"
                   style="max-width:520px;background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #e0e0e0;">

                {{-- Header --}}
                <tr>
                    <td style="background:#0f0f0f;padding:36px;text-align:center;">

                        {{-- Icon Box --}}
                        <div
                            style="display:inline-block;width:44px;height:44px;background:rgba(255,255,255,0.08);border-radius:12px;margin-bottom:14px;border:1px solid rgba(255,255,255,0.12);vertical-align:middle;line-height:44px;text-align:center;">
                            <img src="https://img.icons8.com/ios/50/ffffff/layers.png"
                                 width="22" height="22"
                                 alt=""
                                 style="vertical-align:middle;display:inline-block;"/>
                        </div>

                        <p style="margin:0;font-size:17px;font-weight:600;color:#ffffff;letter-spacing:0.3px;">
                            {{ config('app.name') }}
                        </p>
                    </td>
                </tr>

                {{-- Body --}}
                <tr>
                    <td style="padding:36px 36px 28px;">

                        {{-- Badge --}}
                        <p style="display:inline-block;margin:0 0 20px;font-size:11px;font-weight:500;color:#92400e;background:#fffbeb;padding:4px 10px;border-radius:20px;border:1px solid #fde68a;letter-spacing:0.4px;">
                            REDEFINIÇÃO DE SENHA
                        </p>

                        {{-- Title --}}
                        <p style="margin:0 0 10px;font-size:22px;font-weight:600;color:#0f0f0f;letter-spacing:-0.5px;line-height:1.3;">
                            Redefinir sua senha
                        </p>

                        {{-- Message --}}
                        <p style="margin:0 0 28px;font-size:15px;color:#6b7280;line-height:1.65;">
                            Olá, <strong style="color:#111827;">{{ $notifiable->name }}</strong>!
                            Recebemos uma solicitação para redefinir a senha da sua conta. Clique no botão abaixo para
                            criar uma nova senha.
                        </p>

                        {{-- Button --}}
                        <table cellpadding="0" cellspacing="0" style="margin:0 0 28px;">
                            <tr>
                                <td style="background:#0f0f0f;border-radius:10px;">
                                    <a href="{{ $url }}"
                                       style="display:inline-block;padding:14px 32px;font-size:15px;font-weight:500;color:#ffffff;text-decoration:none;letter-spacing:0.2px;">
                                        Redefinir senha &rarr;
                                    </a>
                                </td>
                            </tr>
                        </table>

                        {{-- Expiry Notice --}}
                        <table cellpadding="0" cellspacing="0" width="100%"
                               style="background:#fafafa;border:1px solid #e5e7eb;border-radius:10px;">
                            <tr>
                                <td style="padding:14px 16px;">
                                    <p style="margin:0;font-size:13px;color:#9ca3af;line-height:1.5;">
                                        &#9201; Este link expira em <strong style="color:#6b7280;">60 minutos</strong>.
                                        Se você não solicitou a redefinição, ignore este e-mail — sua senha permanece a
                                        mesma.
                                    </p>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                {{-- Divider --}}
                <tr>
                    <td style="padding:0 36px;">
                        <div style="height:1px;background:#f3f4f6;"></div>
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td style="padding:20px 36px 28px;">
                        <p style="margin:0 0 6px;font-size:12px;color:#9ca3af;line-height:1.5;">
                            Problemas com o botão? Copie e cole o link abaixo no seu navegador:
                        </p>
                        <p style="margin:0;font-size:12px;color:#6b7280;font-family:monospace;word-break:break-all;background:#f9fafb;padding:10px 12px;border-radius:8px;border:1px solid #e5e7eb;">
                            {{ $url }}
                        </p>
                    </td>
                </tr>

            </table>

            {{-- Social Media --}}
            <table cellpadding="0" cellspacing="0" style="margin-top:24px;text-align:center;">
                <tr>
                    <td>
                        <p style="margin:0 0 14px;font-size:12px;color:#9ca3af;letter-spacing:0.3px;">SIGA-NOS</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        {{-- Instagram --}}
                        <a href="#" style="display:inline-block;margin:0 5px;text-decoration:none;">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width:38px;height:38px;background:#ffffff;border-radius:10px;border:1px solid #e5e7eb;text-align:center;vertical-align:middle;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg" style="display:block;margin:auto;">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="#E1306C"
                                                  stroke-width="1.8"/>
                                            <circle cx="12" cy="12" r="4.5" stroke="#E1306C" stroke-width="1.8"/>
                                            <circle cx="17.5" cy="6.5" r="1" fill="#E1306C"/>
                                        </svg>
                                    </td>
                                </tr>
                            </table>
                        </a>

                        {{-- Facebook --}}
                        <a href="#" style="display:inline-block;margin:0 5px;text-decoration:none;">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width:38px;height:38px;background:#ffffff;border-radius:10px;border:1px solid #e5e7eb;text-align:center;vertical-align:middle;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg" style="display:block;margin:auto;">
                                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"
                                                  stroke="#1877F2" stroke-width="1.8" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                        </svg>
                                    </td>
                                </tr>
                            </table>
                        </a>

                        {{-- Twitter / X --}}
                        <a href="#" style="display:inline-block;margin:0 5px;text-decoration:none;">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width:38px;height:38px;background:#ffffff;border-radius:10px;border:1px solid #e5e7eb;text-align:center;vertical-align:middle;">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="#0f0f0f"
                                             xmlns="http://www.w3.org/2000/svg" style="display:block;margin:auto;">
                                            <path
                                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L2.14 2.25H8.5l4.265 5.638L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/>
                                        </svg>
                                    </td>
                                </tr>
                            </table>
                        </a>

                        {{-- LinkedIn --}}
                        <a href="#" style="display:inline-block;margin:0 5px;text-decoration:none;">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width:38px;height:38px;background:#ffffff;border-radius:10px;border:1px solid #e5e7eb;text-align:center;vertical-align:middle;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg" style="display:block;margin:auto;">
                                            <path
                                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"
                                                stroke="#0A66C2" stroke-width="1.8" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <rect x="2" y="9" width="4" height="12" stroke="#0A66C2" stroke-width="1.8"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="4" cy="4" r="2" stroke="#0A66C2" stroke-width="1.8"/>
                                        </svg>
                                    </td>
                                </tr>
                            </table>
                        </a>

                        {{-- YouTube --}}
                        <a href="#" style="display:inline-block;margin:0 5px;text-decoration:none;">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width:38px;height:38px;background:#ffffff;border-radius:10px;border:1px solid #e5e7eb;text-align:center;vertical-align:middle;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg" style="display:block;margin:auto;">
                                            <path
                                                d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"
                                                stroke="#FF0000" stroke-width="1.8"/>
                                            <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" stroke="#FF0000"
                                                     stroke-width="1.8" stroke-linejoin="round"/>
                                        </svg>
                                    </td>
                                </tr>
                            </table>
                        </a>
                    </td>
                </tr>
            </table>

            {{-- Bottom --}}
            <table cellpadding="0" cellspacing="0" style="margin-top:16px;text-align:center;">
                <tr>
                    <td style="padding-bottom:8px;">
                        <p style="margin:0;font-size:12px;color:#9ca3af;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin:0;font-size:12px;">
                            <a href="#" style="color:#9ca3af;text-decoration:none;">Cancelar inscri&ccedil;&atilde;o</a>
                            &nbsp;&middot;&nbsp;
                            <a href="#" style="color:#9ca3af;text-decoration:none;">Pol&iacute;tica de privacidade</a>
                        </p>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>

</body>
</html>
