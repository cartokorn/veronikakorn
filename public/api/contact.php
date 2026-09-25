<?php

const RECIPIENT = 'vkorn1962@gmail.com';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Methode nicht erlaubt.');
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$subject = trim((string) ($_POST['subject'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit('Bitte füllen Sie alle Pflichtfelder korrekt aus.');
}

$cleanSubject = preg_replace('/[\r\n]+/', ' ', $subject);
$cleanSubject = $cleanSubject !== '' ? $cleanSubject : "Neue Kontaktanfrage von $name";
$cleanSubject = mb_substr($cleanSubject, 0, 150);
$body = "Name: $name\nE-Mail: $email\n\nNachricht:\n$message";
$headers = [
    'From: Veronika Korn Website <' . RECIPIENT . '>',
    'Reply-To: ' . $email,
    'Content-Type: text/plain; charset=UTF-8',
];

if (!mail(RECIPIENT, $cleanSubject, $body, implode("\r\n", $headers))) {
    http_response_code(500);
    exit('Die Nachricht konnte nicht gesendet werden.');
}

$copyBody = "Vielen Dank für Ihre Nachricht. Hier ist eine Kopie Ihrer Anfrage:\n\n$body";
$copyHeaders = [
    'From: Veronika Korn <' . RECIPIENT . '>',
    'Reply-To: ' . RECIPIENT,
    'Content-Type: text/plain; charset=UTF-8',
];

// The copy is a courtesy; the request already reached the recipient, so a failure here is ignored.
mail($email, "Kopie: $cleanSubject", $copyBody, implode("\r\n", $copyHeaders));

header('Location: /contact?success=1', true, 303);
exit;