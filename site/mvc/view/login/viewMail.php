<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Réinitialisation de mot de passe</title>
</head>
<body>
  <h1>Réinitialisation de mot de passe</h1>
  <p>Bonjour,</p>
  <p>Nous avons reçu une demande de réinitialisation de mot de passe pour votre compte. Si vous n'avez pas effectué cette demande, veuillez ignorer ce message.</p>
  <p>Pour réinitialiser votre mot de passe, cliquez sur le bouton ci-dessous. Ce lien expirera dans 15 minutes.</p>
  <!-- <a href="/login/resetPassword" target="_blank">Réinitialiser mon mot de passe</a> -->
  <a href="/login/resetPassword?token=<?= urlencode($token)?>&email=<?=urlencode($email)?>" target="_blank">Réinitialiser mon mot de passe</a>

  <p>Si vous rencontrez des difficultés pour réinitialiser votre mot de passe, veuillez contacter notre support technique à l'adresse suivante : <a href="mailto:support@example.com">support@example.com</a>.</p>
  <p>Cordialement,</p>
  <p>L'équipe de support technique d'YDDOC.com</p>
</body>
</html>