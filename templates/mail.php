<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form input and make sure it's sanitized.
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $name = strip_tags(trim($name));
    $name = str_replace(array('\r', '\n'), array('', ''), $name);
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $message = isset($_POST['message']) ? $_POST['message'] : null;
    $message = trim($message);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo 'Oops! There was a problem with your submission. Please complete the form and try again';
        exit;
    }

    $recipient = "info@d2am.net";
    $subject = "Tournament Register Contact. From: $name";

    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message: \n$message\n";

    $email_header = "From: $name <$email>";

    if(mail($recipient, $subject, $email_content, $email_header)) {
        http_response_code(200);
        echo 'Thank You! Your message has been sent.';
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your message, please try again.";
}