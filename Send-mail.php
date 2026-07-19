<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user form input values against script injection attempts
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone   = strip_tags(trim($_POST["phone"]));
    $subject = strip_tags(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Check mandatory constraints data completion metrics
    if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Error: Please complete the entire form and verify your email input fields correctly.";
        exit;
    }

    // Target Receiving Mail Box destination address set as requested
    $recipient = "jvinfotech88@gmail.com";

    // Set transactional transmission envelope subject header structural alignment
    $email_subject = "New Contact Inquiry: $subject from $name";

    // Format the email message body clearly
    $email_content = "You have received a new message from your website contact form.\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone Number: $phone\n\n";
    $email_content .= "Message Context Details:\n$message\n";

    // Construct transmission header configurations safely matching mail server regulations
    $email_headers = "From: JV Infotech Website <noreply@jvinfotech.com>\r\n";
    $email_headers .= "Reply-To: $name <$email>\r\n";
    $email_headers .= "X-Mailer: PHP/" . phpversion();

    // Fire the message delivery process
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank you! Your inquiry message statement was successfully sent.";
    } else {
        http_response_code(500);
        echo "Server System Configuration Error: We could not process message delivery parameters at this moment.";
    }
} else {
    http_response_code(403);
    echo "Access Prohibited Error: Forms must utilize valid POST transmission sequences to pass parameters.";
}
?>