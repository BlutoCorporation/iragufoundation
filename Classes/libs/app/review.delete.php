<?php

include "../load.php";

$id = $_GET['review_id'];

$conn = Database::getConnection();
$sql = "DELETE FROM `review` WHERE `id` = $id";
$result = $conn->query($sql);
if ($result) {
    header("Location: ../../welcome");
}

?>