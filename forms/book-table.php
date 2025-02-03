<?php
// Replace this with the actual email address where you want to receive the emails
$to = "deveshu8@example.com";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = "New table booking request from the website";
    $message = strip_tags(trim($_POST["message"]));

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
    $time = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
    $people = filter_var($_POST['people'], FILTER_SANITIZE_NUMBER_INT);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);


    // Check that data is valid
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Return a 400 error if data is invalid
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Date: $date\n";
    $email_content .= "Time: $time\n";
    $email_content .= "Number of People: $people\n";
    $email_content .= "Message:\n$message\n";
    


    // Email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    if (mail($to, $subject, $email_content, $email_headers)) {
        // Success message
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        // Failure message
        http_response_code(500);
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    // Not a POST request
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
