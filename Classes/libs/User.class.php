<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

class User
{
    public $conn = null;

    public static function register($name, $password, $email, $phone, $standard)
    {
        $options = [
            'cost' => 9,
        ];
        $pass = password_hash($password, PASSWORD_BCRYPT, $options);
        $conn = Database::getConnection();

        // Generate a random 6-digit OTP
        $otp = random_int(100000, 999999);
        // Set OTP expiry time (valid for 5 minutes)
        $otpExpiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `created_at`, `otp`, `otp_expiry`, `status`, `forgot`) 
                VALUES ('$name', '$pass', '$email', '$phone', now(), '$otp', '$otpExpiry', 'not', NULL);";
        try {
            if ($conn->query($sql)) {
                $avatar = "../assets/img/user.png";
                $userid = mysqli_insert_id($conn);
                $sql = "INSERT INTO `users` (`userid`, `avatar`, `gender`, `location`, `std`, `uploaded_time`, `owner`)
                VALUES ('$userid', '$avatar', '', '', '$standard', now(), '$name');";
                try {
                    if ($conn->query($sql)) {
                        // Send OTP to the user's email
                        if (User::sendOTP($email, $otp)) {
                            header("Location: verify-email");
                            exit; // Always use exit after header to prevent further code execution
                        } else {
                            throw new Exception("Error sending OTP.");
                        }
                    } else {
                        throw new Exception("Error creating user profile: " . $conn->error);
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                    return false;
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            return false;
        }
    }

    // Function to send OTP email using PHPMailer
    public static function sendOTP($email, $otp)
    {
        $mail = new PHPMailer(true);

        Session::start();
        Session::regenerate();
        Session::set("Loggedin", $email);  // Store email in session

        try {
            // SMTP configuration
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'bluto.teams@gmail.com'; // Your email address
            $mail->Password = get_config('mail_pass'); // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email setup
            $mail->setFrom('bluto.teams@gmail.com', 'IraguFoundation'); // Sender's email and name
            $mail->addAddress($email); // Add recipient email
            $mail->Subject = 'Verification Code';
            $path = get_config('base_path');
            $mail->Body = "<div style='background: #fafafa;'>
                                <div class='container' style='max-width: 600px; margin: 20px auto; background: #FFF; border-radius: 8px; overflow: hidden; padding: 32px 16px; text-align: center;'>
                                    <div class='logo'>
                                        <img src='https://iragufoundation.org/assets/img/logo.jpg' style='background: #FFF; border-radius: 1rem; width: 280px; height: auto;' alt='Logo' />
                                        <!-- assets/images/logo/logo.png -->                                    
                                    </div>

                                    <h1 style='font-size: 24px; margin: 20px 0 10px;'>Please confirm your email</h1>
                                    <p style='font-size: 16px; margin: 10px 0; color: #555;'>Use this code to confirm your email and complete signin.</p>

                                    <div class='otp-box' style='background: #9E9E9E; margin: 20px auto; display: inline-block; padding: 16px 24px; border-radius: 8px; font-size: 32px; font-weight: bold; color: #FFF;'>
                                        {$otp}
                                    </div>

                                    <p style='font-size: 16px; margin: 10px 0; color: #555;'>
                                        This code is valid for 5 minutes.
                                    </p>
                                </div>
                            </div>";
            $mail->isHTML(true); // Set to plain text

            // At the start of your script, enable output buffering if necessary
            ob_start();

            // Your PHPMailer code
            $mail->SMTPDebug = 0; // Disable SMTP debugging output

            // Send email
            if ($mail->send()) {
                return true;
            } else {
                echo "PHPMailer Error: " . $mail->ErrorInfo;
                return false;
            }

            // At the end of the script, flush the buffer if needed
            ob_end_flush();
        } catch (Exception $e) {
            print_r("PHPMailer Exception: " . $e->getMessage());
            return false;
        }
    }

    // Function to verify OTP and handle expiry logic
    public static function verifyOTP($email, $otp)
    {
        $conn = Database::getConnection();
        $query = "SELECT `otp`, `otp_expiry`, `status`, `forgot` FROM `auth` WHERE `email` = '$email' OR `username` = '$email' OR `phone` = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $forgot = $row['forgot'];
            $dbtime = $row['otp_expiry'];
            $expiryTimestamp = strtotime($dbtime);
            if ($expiryTimestamp === false) {
                return "Invalid or expired OTP.";
            }

            if ($row['otp'] == trim($otp) && $expiryTimestamp >= time()) {
                $setFields = "`otp` = NULL, `otp_expiry` = '$dbtime'";
                if ($forgot === NULL) {
                    $setFields .= ", `otp_expiry` = NULL, `status` = 'verified'";
                }
                $conn->query("UPDATE `auth` SET $setFields WHERE email = '$email' OR username = '$email' OR phone = '$email'");
                return true;
            } else {
                return "Invalid or expired OTP.";
            }
        } else {
            return "User not found.";
        }
    }

    // Function to handle OTP resend
    public static function resendOTP($email)
    {
        $conn = Database::getConnection();
        $query = "SELECT `otp`, `otp_expiry` FROM `auth` WHERE `email` = '$email' OR `username` = '$email' OR `phone` = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Check if OTP can be resent (only after expiry or 60 seconds have passed)
            $expiryTimestamp = strtotime($row['otp_expiry']);
            if ((string)$expiryTimestamp < time()) {
                // OTP has expired, generate a new OTP
                $otp = random_int(100000, 999999);
                $otp = (String)$otp;
                $otpExpiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));
                $conn->query("UPDATE `auth` SET `otp` = '$otp', `otp_expiry` = '$otpExpiry' WHERE `email` = '$email' OR `username` = '$email' OR `phone` = '$email'");
                
                // Send the new OTP
                if (User::sendOTP($email, $otp)) {
                    return true;
                } else {
                    return "Error sending OTP.";
                }
            } else {
                return "You can resend the OTP after it expires.";
            }
        } else {
            return "User not found.";
        }
    }
    public static function forGot($email)
    {
        $conn = Database::getConnection();
        $query = "SELECT `otp`, `otp_expiry` FROM `auth` WHERE `email` = '$email' OR `username` = '$email' OR `phone` = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $otp = random_int(100000, 999999);
            $otp = (String)$otp;
            $otpExpiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));
            $conn->query("UPDATE `auth` SET `otp` = '$otp', `otp_expiry` = '$otpExpiry', `forgot` = 'reset' WHERE `email` = '$email' OR `username` = '$email' OR `phone` = '$email'");
            
            // Send the new OTP
            if (User::sendOTP($email, $otp)) {
                return true;
            } else {
                return "Error sending OTP.";
            }
        } else {
            return "User not found.";
        }
    }

    public static function resetPass($new, $conf)
    {
        if ($new === $conf) {
            $conn = Database::getConnection();

            $email = Session::get('Loggedin') ?? header('Location: forgot-password');

            $query = "SELECT `id` FROM `auth` WHERE `email` = '$email' OR `username` = '$email' OR `phone` = '$email'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $options = [
                    'cost' => 9,
                ];
                $password = password_hash($new, PASSWORD_BCRYPT, $options);
                $update = "UPDATE `auth` SET `password` = '$password', `otp_expiry` = NULL, `forgot` = NULL WHERE `email` = '$email' OR `username` = '$email' OR `phone` = '$email'";
                try {
                    if ($conn->query($update)) {
                        header("Location: index");
                        exit;
                    } else {
                        throw new Exception('Password Update Error: ' . mysqli_error($db));
                        return false;
                    }
                } catch (Exception $e) {
                    return 'Password Error: ' . $e->getMessage();
                }
            } else {
                return false;
            }
        } else {
            return 'Confirmation does not match the password.';
        }
    }

    // Function for login
    public static function login($user, $pass)
    {
        Session::start();
        $conn = Database::getConnection();
        $query = "SELECT * FROM `auth` WHERE `username` = '$user' OR `email` = '$user' OR `phone` = '$user'";
        $result = $conn->query($query);
        if ($result && $result->num_rows === 1)
        {
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password']))
            {
                Session::regenerate();
                Session::set("Loggedin", $user);
                header("Location: welcome");
                exit;
            }
            else
            {
                return "Invalid password!";
            }
        } elseif ($result && $result->num_rows > 1) {
            // Handle multiple rows case (unexpected behavior)
            return "Multiple accounts found. Please contact support.";
        } else {
            return "User not found!";
        }
    }

    public static function setUser($user, $email, $phone, $gen, $locat, $standard)
    {
        $conn = Database::getConnection();
        $currentUser = Operations::getUser();
        $uid = $currentUser['id']; // Retrieve the user ID from the current session
        
        // Update the users table with new profile data
        $query = "UPDATE `users` SET 
            `location` = '$locat',
            `gender` = '$gen', 
            `std` = '$standard'
            WHERE `userid` = '$uid'";
            
        try {
            if ($conn->query($query)) {
                $sql = "UPDATE `auth` SET 
                    `username` = '$user', 
                    `email` = '$email', 
                    `phone` = '$phone' 
                    WHERE `id` = '$uid'";
                    
                if ($conn->query($sql)) {
                    // Check if the email has been changed
                    // echo $currentUser['email'];
                    // die($email);
                    if ($currentUser['email'] != $email) {
                        // Generate a new OTP
                        $otp = random_int(100000, 999999);
                        // Set OTP expiry time (valid for 5 minutes)
                        $otpExpiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));
                        $qry = "UPDATE `auth` SET 
                            `otp` = '$otp', 
                            `otp_expiry` = '$otpExpiry', 
                            `status` = 'not'
                            WHERE `id` = '$uid'";
                            
                        if ($conn->query($qry)) {
                            // Send OTP to the user's email
                            if (User::sendOTP($email, $otp)) {
                                // return "OTP sent to your email. Please verify.";
                                header("Location: verify-email");
                                exit;
                            } else {
                                throw new Exception("Error sending OTP.");
                            }
                        } else {
                            throw new Exception("Error updating OTP in database: " . $conn->error);
                        }
                    } else {
                        // die("Hello");
                        // return "Updated successfully!";
                        header("Location: profile");
                        exit;
                    }
                } else {
                    throw new Exception("Error updating user profile in 'auth' table: " . $conn->error);
                }
            } else {
                throw new Exception("Error updating user profile in 'users' table: " . $conn->error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function setNewPass($old, $new, $conf)
    {
        if ($new === $conf) {
            $db = Database::getConnection();
            $currentUser = Operations::getUser();
            $id = $currentUser['id']; // Retrieve the user ID from the current session
            $query = "SELECT `password` FROM `auth` WHERE `id` = '$id'";
            $result = $db->query($query);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($old, $row['password'])) {
                    $options = [
                        'cost' => 9,
                    ];
                    $password = password_hash($new, PASSWORD_BCRYPT, $options);
                    $update_profile = "UPDATE `auth` SET `password` = '$password' WHERE `id` = '$id'";
                    try {
                        if ($db->query($update_profile)) {
                            header("Location: profile");
                            return true;
                        } else {
                            throw new Exception('Password Update Error: ' . mysqli_error($db));
                            return false;
                        }
                    } catch (Exception $e) {
                        echo "<script>alert('Password Error: {$e->getMessage()}');</script>";
                        return false;
                    }
                } else {
                    return 'Verify Password Error.';
                }
            } else {
                return false;
            }
        } else {
            return 'Confirmation does not match the password.';
        }
    }

    public static function setAvatar($avatar, $fileSize)
    {
        $conn = Database::getConnection();
        $currentUser = Operations::getUser();
        $id = $currentUser['id'];

        // File upload directory 
        $targetDir = "uploads/avatars/";

        // Create the directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory with proper permissions
        }

        // Check if a file is uploaded
        if (!empty($_FILES["avatar"]["name"])) {
            $fileName = basename($_FILES["avatar"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Check file size (4MB max)
            if ($fileSize > 8 * 1024 * 1024) {
                $error = "File size should be below 8 MB.";
            } else {
                // Allowable file types
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

                if (in_array($fileType, $allowTypes)) {
                    // Generate a unique file name to avoid overwriting existing files
                    $newFileName = uniqid('avatar_', true) . '.' . $fileType;
                    $targetFilePath = $targetDir . $newFileName;

                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath)) {

                        // Delete old image if it exists
                        if (!empty($currentUser['avatar']) && file_exists($currentUser['avatar'])) {
                            unlink($currentUser['avatar']);
                        }

                        // Update the user's avatar in the database
                        $sql = "UPDATE `users` SET `avatar` = '$targetFilePath' WHERE `userid` = '$id'";

                        if ($conn->query($sql)) {
                            // return "The file has been uploaded and the avatar updated successfully.";
                            header("Location: profile");
                            exit;
                        } else {
                            return "Database insertion failed: " . $conn->error;
                        }
                    } else {
                        return "Sorry, there was an error uploading your file.";
                    }
                } else {
                    return "Only JPG, JPEG, PNG, & GIF files are allowed.";
                }
            }
        } else {
            return "No file selected for upload.";
        }
    }

    public static function removeAvatar() 
    {
        $conn = Database::getConnection();
        $currentUser = Operations::getUser();
        $id = $currentUser['id'];

        // Default avatar path
        $avatar = "../assets/img/user.png";

        // Delete old image if it exists
        if (!empty($currentUser['avatar']) && file_exists($currentUser['avatar'])) {
            unlink($currentUser['avatar']);
        }

        // Update the database with the default avatar
        $sql = "UPDATE `users` SET `avatar` = '$avatar' WHERE `userid` = '$id'";  // Make sure the column name is `uid`

        if ($conn->query($sql)) {
            // return "The avatar has been removed successfully.";
            header("Location: profile");
            exit;
        } else {
            return "Database update failed: " . $conn->error;
        }
    }

    // public static function setReview($rating, $review, $uid)
    // {
    //     $conn = Database::getConnection();
    //     $currentUser = Operations::getUser();
    //     $owner = $currentUser['username'];
    //     $user = $_GET['username'];

    //     $sql = "INSERT INTO `review` (`userid`, `rating`, `review`, `uploaded_time`, `owner`, `user`) 
    //             VALUES ('$uid', '$rating', '$review', now(), '$owner', '$user');";
    //     if ($conn->query($sql))
    //     {
    //         return "Your review uploaded!";
    //     }
    //     else
    //     {
    //         return "Some problem on your review upload!";
    //     }
    // }
}

?>