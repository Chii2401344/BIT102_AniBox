<?php
// Include the database connection file and start the session
require "connect.php";
session_start();

// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Load Composer's autoloader

$mail = new PHPMailer(true); // Create a new PHPMailer instance

// Start the OTP request process if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email from the form
    $email = $_POST["email"];

    // Check if the email exists in the database
    $sql = "SELECT Email FROM user WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the email exists in the database
    if ($row = $result->fetch_assoc()) {
        // Email exists, check if OTP was sent recently
        if (isset($_SESSION['otp-time']) && time() - $_SESSION['otp-time'] < 30) {
            echo "<script>alert('An OTP has been sent to your email recently. Please wait 30 seconds before requesting a new OTP.');</script>";
            echo "<script>window.location.href = 'enter-otp.html';</script>"; // Redirect to request OTP page
            exit();
        } else {
            // Email found, proceed to send OTP
            $otp = rand(100000, 999999); // Generate a random 6-digit OTP

            // Store the OTP, email, and time in the session
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;
            $_SESSION['otp-time'] = time();

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'joyyylx@gmail.com';
                $mail->Password = 'rrwwoipicsewilqr';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
        
                // Email content
                $mail->setFrom('joyyylx@gmail.com', 'AniBox');
                $mail->addAddress($email);
        
                $mail->isHTML(true);
                $mail->Subject = 'OTP Verification for AniBox';
                $mail->Body    = "This is the OTP which will be used to reset your password: <br>$otp"; // HTML content for OTP
            
                // Send email
                $mail->send();
                echo "<script>alert('OTP sent to your email!');</script>";
                echo "<script>window.location.href = 'enter-otp.html';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
            }
        }
    } else {
        // Email not found in database
        header("Location: request-otp.html?error=email-not-found");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
