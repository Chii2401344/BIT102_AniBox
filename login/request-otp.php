<?php
// Include the database connection file and start the session
require "connect.php";
session_start();

// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  // Load Composer's autoloader

$mail = new PHPMailer(true);  // Create a new PHPMailer instance

// Start the OTP request process if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];  // Get the email from the form

    // Validate the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.');</script>";
        exit();
    }

    // Validate the input to prevent SQL injection
    $sql = "SELECT Username, Email FROM user WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the email exists in the database
    if ($row = $result->fetch_assoc()) {
        // Email exists, check if OTP was sent recently
        if (isset($_SESSION['otp-time']) && time() - $_SESSION['otp-time'] < 30) {
            echo "<script>alert('An OTP has been sent to your email recently. Please wait 30 seconds before requesting a new OTP.');</script>";
            echo "<script>window.location.href = 'enter-otp.html';</script>";
            exit();
        } else {
            // Email found, proceed to send OTP
            $otp = rand(100000, 999999);  // Generate a random 6-digit OTP

            // Store the OTP, email, and time in the session
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;
            $_SESSION['otp-time'] = time();

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'joyyylx@gmail.com';  // Sender's email address
                $mail->Password = 'paipvuwxlolebzbw';   // Sender's App Password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
        
                // Email content
                $mail->setFrom('joyyylx@gmail.com', 'AniBox');
                $mail->addAddress($email);
        
                $mail->isHTML(true);
                $mail->Subject = 'AniBox OTP Verification';
                $mail->Body = "
                    <p>Dear user <strong>{$row['Username']}</strong>,</p>
                    <p>Here is your OTP for password reset: <strong>$otp</strong></p>
                    <p>If you did not request this, please ignore this email.</p>
                    <p><em>Thank you,<br>AniBox</em></p>
                ";
            
                // Send email
                $mail->send();
                echo "<script>alert('OTP sent to your email!');</script>";
                echo "<script>window.location.href = 'enter-otp.html';</script>";
                
            } catch (Exception $e) {
                // Log the error for debugging purposes
                error_log('Mailer Error: ' . $mail->ErrorInfo);
                echo "<script>alert('Failed to send OTP. Please try again later.');</script>";
                echo "<script>window.location.href = 'request-otp.html';</script>";
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
