<?php

class Operations
{
    public static function getUser()
    {
        $conn = Database::getConnection();
        $userSession = $conn->real_escape_string(Session::get('Loggedin'));

        $sql = "SELECT `auth`.*, `users`.`avatar`, `users`.`gender`, `users`.`location`, `users`.`std`, `users`.`uploaded_time`, `users`.`owner` FROM `auth` LEFT JOIN `users` ON `auth`.`id` = `users`.`userid` WHERE `auth`.`email` = '$userSession' OR `auth`.`username` = '$userSession' OR `auth`.`phone` = '$userSession' LIMIT 1";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public static function getUserAccount()
    {
        $conn = Database::getConnection();
        $loguser = Session::get('Loggedin');
        $sql = "SELECT * FROM `users` WHERE `owner` = '$loguser'";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public static function getuserProfile()
    {
        $username = $_GET['username'];
        $db = Database::getConnection();
        $sql = "SELECT * FROM `users` WHERE `owner`='$username'";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    public static function getAllProfiles()
    {
        $conn = Database::getConnection();
        $field = $_GET['field'];
        $sql = "SELECT * FROM `users` WHERE `field` = '$field'";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    // public static function getReview()
    // {
    //     $conn = Database::getConnection();
    //     if (isset($_GET['username'])) {
    //         $user = $_GET['username'];
    //     } else {
    //         $currentUser = Operations::getUser();
    //         $user = $currentUser['username'];
    //     }
    //     $sql = "SELECT * FROM `review` WHERE `user` = '$user'";
    //     $result = $conn->query($sql);
    //     return iterator_to_array($result);
    // }

    // public static function getReviewCount()
    // {
    //     $user = $_GET['username'];
    //     $conn = Database::getConnection(); // Assuming this returns a MySQLi connection
    //     $sql = "SELECT COUNT(*) AS `owner` FROM `review` WHERE `owner` = '$user'";
    //     $result = $conn->query($sql);
        
    //     // Fetch the result as an associative array and return the count
    //     $row = $result->fetch_assoc();
    //     return $row['owner'];
    // }

    // public static function getTopReview()
    // {
    //     $conn = Database::getConnection(); // Assuming this returns a MySQLi connection
    //     $currentUser = Operations::getUser();
    //     $user = $currentUser['username'];
    //     // SQL query to get the most frequent and largest rating
    //     $sql = "SELECT `rating`, COUNT(`rating`) as occurrences FROM `review` WHERE `user` = '$user' GROUP BY `rating` ORDER BY occurrences DESC, `rating` DESC LIMIT 1";
    //     $result = $conn->query($sql);
        
    //     if ($result->num_rows > 0) {
    //         // Output the result
    //         $row = $result->fetch_assoc();
    //         return $row['rating'];
    //     } else {
    //         return "No records found.";
    //     }
    // }
    // public static function getTopReviewProfile()
    // {
    //     $user = $_GET['username'];
    //     $conn = Database::getConnection(); // Assuming this returns a MySQLi connection

    //     $query = "SELECT `id` FROM `users` WHERE `owner` = '$user'";
    //     $result = $conn->query($query);
    //     $row = $result->fetch_assoc();
    //     $userid = $row['id'];

    //     // SQL query to get the most frequent and largest rating
    //     $sql = "SELECT `rating`, COUNT(`rating`) as occurrences FROM `review` WHERE `userid` = '$userid' GROUP BY `rating` ORDER BY occurrences ASC, `rating` ASC LIMIT 1";
    //     $result = $conn->query($sql);

    //     if ($result->num_rows > 0) {
    //         // Output the result
    //         $row = $result->fetch_assoc();
    //         return $row['rating'];
    //     } else {
    //         return "No records found.";
    //     }
    // }
}

?>
