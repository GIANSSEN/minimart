<!DOCTYPE html>
<html>
<head>
    <title>Registration Pending Approval</title>
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); color: #ffffff; padding: 30px 20px; text-align: center; }
        .header h2 { margin: 0; font-weight: 600; font-size: 24px; }
        .content { padding: 40px 30px; line-height: 1.6; color: #4a5568; font-size: 16px; }
        .content strong { color: #2d3748; }
        .footer { background-color: #f8f9fc; padding: 20px; text-align: center; font-size: 13px; color: #858796; border-top: 1px solid #eaecf4; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Welcome to Minimart POS</h2>
        </div>
        <div class="content">
            <p>Hi <strong>{{ $user->full_name }}</strong>,</p>
            <p>Thank you for registering your account at our POS system.</p>
            <p>Your account is currently <strong>pending approval</strong> from an administrator. For security reasons, a manager must review and approve your registration before you can log in.</p>
            <p>You will receive another email notification as soon as your account has been approved and activated.</p>
            <p>We appreciate your patience!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Minimart POS. All rights reserved.
        </div>
    </div>
</body>
</html>
