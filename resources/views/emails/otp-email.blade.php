<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode OTP Login - BKJ Group</title>
    <style>
        body {
            font-family: 'Poppins', Helvetica, Arial, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 28, 46, 0.05);
            border: 1px solid #ebeef0;
        }
        .header {
            background-color: #001c2e;
            padding: 30px;
            text-align: center;
        }
        .header h2 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 40px 30px;
            color: #181c1e;
            line-height: 1.6;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .instructions {
            color: #42474d;
            margin-bottom: 30px;
        }
        .otp-container {
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            display: inline-block;
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 6px;
            color: #006e2d;
            background-color: #f1f4f6;
            padding: 12px 30px;
            border-radius: 6px;
            border: 1px solid #c2c7ce;
        }
        .warning {
            font-size: 13px;
            color: #ba1a1a;
            background-color: #ffdad6;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 30px;
            text-align: center;
        }
        .footer {
            background-color: #f1f4f6;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #72787e;
            border-top: 1px solid #ebeef0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>BKJ GROUP</h2>
        </div>
        <div class="content">
            <div class="greeting">Halo,</div>
            <p class="instructions">Berikut adalah kode verifikasi sekali pakai (OTP) Anda untuk masuk ke Operations Portal BKJ Group:</p>
            
            <div class="otp-container">
                <span class="otp-code">{{ $otpCode }}</span>
            </div>
            
            <div class="warning">
                <strong>PENTING:</strong> Kode ini hanya berlaku selama 5 menit. Jangan berikan kode ini kepada siapa pun demi keamanan akun Anda.
            </div>
            
            <p style="color: #42474d; margin: 0;">Jika Anda tidak mencoba melakukan login, harap abaikan email ini atau hubungi administrator sistem.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} PT Batam Kepri Jaya. All rights reserved.
        </div>
    </div>
</body>
</html>
