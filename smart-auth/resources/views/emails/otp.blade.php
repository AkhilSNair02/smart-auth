<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f4f4; padding: 40px;">
    <div style="max-width:480px;margin:auto;background:#fff;border-radius:8px;padding:32px;">
        <h2 style="color:#1a1a2e;">Verify Your Account</h2>
        <p>Use the OTP below to verify your account. It expires in <strong>5 minutes</strong>.</p>
        <div style="font-size:36px;font-weight:bold;letter-spacing:12px;color:#4f46e5;
                    text-align:center;padding:24px;background:#eef2ff;border-radius:8px;margin:24px 0;">
            {{ $otp }}
        </div>
        <p style="color:#6b7280;font-size:13px;">If you did not request this, ignore this email.</p>
    </div>
</body>
</html>