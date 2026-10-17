
<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method not allowed.");
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$order = trim($_POST["order"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $message === "" ||
    !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit("Please complete all required fields.");
}

$to = "jamani@bitchesgetstitchescrochet.com";
$subject = "New Crochet Order Inquiry";

$body = "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Order Type: $order\n\n";
$body .= "Message:\n$message\n";

$headers = [
    "From" => "jamani@bitchesgetstitchescrochet.com",
    "Reply-To" => $email,
    "Content-Type" => "text/plain; charset=UTF-8"
];

if (mail($to, $subject, $body, $headers)) {
    echo "Thank you! Your message has been submitted.";
} else {
    http_response_code(500);
    echo "Sorry, your message could not be sent.";
}
?>
