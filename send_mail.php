<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitize Inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

    // Validate Required Fields
    if (!$name || !$email || !$phone || !$subject || !$message) {
        echo "All fields are required.";
        exit;
    }

    // ARR Hospital Mail IDs
    $to = "arrhospitaltuticorin@gmail.com";

    // Email Headers
    $headers = "From: ARR Hospital Website <no-reply@arrhospital.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email Body
    $emailBody = "
    <html>
    <head>
        <title>ARR Hospital Contact Form</title>
    </head>
    <body style='font-family: Arial, sans-serif;'>
        <h2 style='color:#0d6efd;'>New Appointment / Enquiry Received</h2>

        <table cellpadding='10' cellspacing='0' border='1' style='border-collapse: collapse; width: 100%;'>
            <tr>
                <td><strong>Name</strong></td>
                <td>{$name}</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>{$email}</td>
            </tr>
            <tr>
                <td><strong>Phone</strong></td>
                <td>{$phone}</td>
            </tr>
            <tr>
                <td><strong>Subject</strong></td>
                <td>{$subject}</td>
            </tr>
            <tr>
                <td><strong>Message</strong></td>
                <td>{$message}</td>
            </tr>
        </table>

        <p style='margin-top:20px;'>
            This message was submitted through the ARR Hospital website contact form.
        </p>
    </body>
    </html>";

    // Send Mail
if (mail($to, $subject, $emailBody, $headers)) {
    // echo "Your enquiry has been sent successfully.";
    echo "Message sent successfully.";
} else {
    // echo "Failed to send enquiry.";
    echo "Failed to send message.";
}

} else {
    echo "Invalid request.";
}
?>
