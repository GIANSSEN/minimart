<!DOCTYPE html>
<html>
<head>
    <title>Account Approved</title>
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%); color: #ffffff; padding: 30px 20px; text-align: center; }
        .header h2 { margin: 0; font-weight: 600; font-size: 24px; }
        .content { padding: 40px 30px; line-height: 1.6; color: #4a5568; font-size: 16px; }
        .btn { display: inline-block; padding: 12px 28px; background-color: #1cc88a; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 25px; margin-bottom: 10px; transition: background-color 0.3s; }
        .btn:hover { background-color: #169b6b; }
        .footer { background-color: #f8f9fc; padding: 20px; text-align: center; font-size: 13px; color: #858796; border-top: 1px solid #eaecf4; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Account Approved</h2>
        </div>
        <div class="content">
            <p>Hi <strong>{{ $user->full_name }}</strong>,</p>
            <p>Great news! Your account at Minimart POS has been officially <strong>approved</strong> by the admin.</p>
            <p>You can now log in to the system and access your dashboard to start working.</p>
            <div style="text-align: center;">
                <a href="{{ route('login') }}" class="btn" style="color:#ffffff;">Log In Now</a>
            </div>
            <br>
            <p>Welcome to the team!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Minimart POS. All rights reserved.
        </div>
    </div>
</body>
</html>
