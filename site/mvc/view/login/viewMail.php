<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Reset password</title>
</head>
<body>
  <h1>Reset password</h1>
  <p>Hello,</p>
  <p>We have received a password reset request for your account. If you have not made this request, please ignore this message.</p>
  <p>To reset your password, click the button below. This link will expire in 15 minutes.</p>
  <a href="/login/resetPassword?token=<?= urlencode($token)?>&email=<?=urlencode($email)?>" target="_blank">Reset password</a>

  <p>If you have any difficulties resetting your password, please contact our technical support at <a href="mailto:support@example.com">support@example.com</a>.</p>
  <p>Cordially,</p>
  <p>YDDOC technical support team</p>
</body>
</html>