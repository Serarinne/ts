<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <section style="max-width:48rem;padding:2rem;margin-left:auto;margin-right:auto;border-radius:.5rem;box-shadow:0 4px 6px -1px rgb(0 0 0 / .1), 0 2px 4px -1px rgb(0 0 0 / .06)">
        <main style="margin-top:.5rem">
            <h2 style="font-size:1.5rem;font-weight:600;color:#111827">Hi {{ $fullName }},</h2>

            <p style="margin-top:1rem;margin-bottom:1rem;line-height:1.75rem;color:#4b5563">
                You requested to re-verify your email. To verify your email, please click the link below:
            </p>

            <a href="https://{{ $ServerDomain }}/verify?token={{ $userToken }}" target="_blank" style="padding:0.75rem 1.5rem;font-size:.875rem;font-weight:500;letter-spacing:.05rem;color:#fff;text-transform:capitalize;transition-duration:.3s;background-color:#3b82f6;border-radius:.5rem;display:inline-block;text-decoration:none;box-shadow:0 1px 2px 0 rgb(0 0 0 / 0.05);cursor:pointer">
                Verify email
            </a>

            <p style="margin-top:1rem;margin-bottom:1.5rem;line-height:1.75rem;color:#4b5563">
                If it's impossible to open this link by clicking the button, copy and paste the following link into your browser:
            </p>
            <a href="https://{{ $ServerDomain }}/verify?token={{ $userToken }}" target="_blank" style="margin-top:1rem;margin-bottom:1.5rem;line-height:1.75rem;color:#3b82f6;text-decoration:underline">
                https://{{ $ServerDomain }}/verify?token={{ $userToken }}
            </a>

            <p style="margin-top:2rem;color:#4b5563">
                Best regards, <br>
                WaifuWall
            </p>
        </main>

        <footer style="margin-top:2rem;padding-top:1rem;border-top:1px solid #e5e7eb">
            <p style="font-size:.875rem;color:#6b7280">
                You received this email because you registered on our site. If you did not do this, please contact us.
            </p>

            <p style="margin-top:.75rem;font-size:.875rem;color:#6b7280">
                Copyright &copy; <?php echo date("Y"); ?> WaifuWall. All Rights Reserved.
            </p>
        </footer>
    </section>
</body>
</html>