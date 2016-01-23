<?php
require("../config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Function to remove HTML / PHP tags and trim whitespace.
    function sanitize_input($field)
    {
        $field = strip_tags(trim($field));
        $field = str_replace(array('\r', '\n'), array('', ''), $field);
        return $field;
    }

    // Make sure all form input is sanitized.
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $name = sanitize_input($name);
    $url = isset($_POST['url']) ? $_POST['url'] : null;
    $url = sanitize_input($url);
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $description = sanitize_input($description);
    $prize = isset($_POST['prize']) ? $_POST['prize'] : null;
    $prize = sanitize_input($prize);
    $fee = isset($_POST['fee']) ? $_POST['fee'] : null;
    $fee = sanitize_input($fee);
    $region = isset($_POST['region']) ? $_POST['region'] : null;
    $signups = isset($_POST['signups']) ? $_POST['signups'] : null;
    $type = isset($_POST['type']) ? $_POST['type'] : null;
    $format = isset($_POST['format']) ? $_POST['format'] : null;
    $format = sanitize_input($format);
    $signups_comment = isset($_POST['signups-comment']) ? $_POST['signups-comment'] : null;
    $signups_comment = sanitize_input($signups_comment);


    if ($type == 'tournament') {
        $submission = new Submission(null, $type, $region, $name, $url, $description, $format, $fee, $prize, $signups, null, null);
        $submission->insert();
        http_response_code(200);
        echo 'Thank You! Your submission has been sent. It will appear in the register once an admin has approved it.';
    }

    else if ($type == 'league') {
        $submission = new Submission(null, $type, $region, $name, $url, $description, null, $fee, $prize, $signups, $signups_comment, null);
        $submission->insert();
        http_response_code(200);
        echo 'Thank You! Your submission has been sent. It will appear in the register once an admin has approved it.';
    }
    else {
        http_response_code(400);
        echo 'Please fill out all required fields.';
    }
} else {
    http_response_code(403);
    echo "There was a problem with your message, please try again.";
}