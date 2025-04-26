<?php

class Operations
{
    public static function getUser()
    {
        $conn = Database::getConnection();
        $user = Session::get('Loggedin');
        $sql = "SELECT * FROM `auth` WHERE `email` = '$user' OR `username` = '$user' OR `phone` = '$user'"; // Fetch only the most recent user
        $result = $conn->query($sql);

        // Check if the query returned any result
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc(); // Get the first row as an associative array
            return $user;
        }

        return null; // Return null if no user is found
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

    public static function getMidea()
    {
        $conn = Database::getConnection();
        $currentUser = Operations::getUser();
        $user = $currentUser['username'];
        $sql = "SELECT * FROM `social` WHERE `owner` = '$user'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return iterator_to_array($result);
        } else {
            error_log("No records found for user: $user"); // Log error for debugging
            return [];
        }
    }
    
    public static function getReview()
    {
        $conn = Database::getConnection();
        if (isset($_GET['username'])) {
            $user = $_GET['username'];
        } else {
            $currentUser = Operations::getUser();
            $user = $currentUser['username'];
        }
        $sql = "SELECT * FROM `review` WHERE `user` = '$user'";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getReviewCount()
    {
        $user = $_GET['username'];
        $conn = Database::getConnection(); // Assuming this returns a MySQLi connection
        $sql = "SELECT COUNT(*) AS `owner` FROM `review` WHERE `owner` = '$user'";
        $result = $conn->query($sql);
        
        // Fetch the result as an associative array and return the count
        $row = $result->fetch_assoc();
        return $row['owner'];
    }

    public static function getTopReview()
    {
        $conn = Database::getConnection(); // Assuming this returns a MySQLi connection
        $currentUser = Operations::getUser();
        $user = $currentUser['username'];
        // SQL query to get the most frequent and largest rating
        $sql = "SELECT `rating`, COUNT(`rating`) as occurrences FROM `review` WHERE `user` = '$user' GROUP BY `rating` ORDER BY occurrences DESC, `rating` DESC LIMIT 1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Output the result
            $row = $result->fetch_assoc();
            return $row['rating'];
        } else {
            return "No records found.";
        }
    }
    public static function getTopReviewProfile()
    {
        $user = $_GET['username'];
        $conn = Database::getConnection(); // Assuming this returns a MySQLi connection

        $query = "SELECT `id` FROM `users` WHERE `owner` = '$user'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $userid = $row['id'];

        // SQL query to get the most frequent and largest rating
        $sql = "SELECT `rating`, COUNT(`rating`) as occurrences FROM `review` WHERE `userid` = '$userid' GROUP BY `rating` ORDER BY occurrences ASC, `rating` ASC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output the result
            $row = $result->fetch_assoc();
            return $row['rating'];
        } else {
            return "No records found.";
        }
    }

    public static function getAvailable()
    {
        $conn = Database::getConnection();
        $currentUser = Operations::getUser();
        $user = $currentUser['username'];
        $sql = "SELECT * FROM `available_time` WHERE `owner` = '$user'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return iterator_to_array($result);
        } else {
            error_log("No records found for user: $user"); // Log error for debugging
            return [];
        }
    }

    public static function getingAvailable()
    {
        if (isset($_GET['username'])) {
            $user = $_GET['username'];
            $conn = Database::getConnection();
            $sql = "SELECT * FROM `available_time` WHERE `owner` = '$user'";
            $result = $conn->query($sql);
            return iterator_to_array($result);
        } else {
            die("No records found for user: $user"); // Log error for debugging
        }
    }

    public static function getAPTS()
    {
        $conn = Database::getConnection();
        $currentUser = Operations::getUser();
        $user = $currentUser['username'];
        $sql = "SELECT * FROM `apts` WHERE `owner` = '$user'";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getAPTCount()
    {
        $conn = Database::getConnection();
        $currentUser = Operations::getUser();
        $user = $currentUser['username'];
        $sql = "SELECT COUNT(`owner`) AS `count` FROM `apts` WHERE `owner` = '$user'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    public static function getAllProfiles()
    {
        $conn = Database::getConnection();
        $field = $_GET['field'];
        $sql = "SELECT * FROM `users` WHERE `field` = '$field'";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
}

?>
