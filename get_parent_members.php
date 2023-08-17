<?php
// Database connection
include_once 'dbConfig.php';


function fetchAllMembers($conn)
{
    $query = "SELECT * FROM Members";
    $statement = $conn->prepare($query);
    $statement->execute();

    // Fetch all rows as associative arrays
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $option = '';
    $option .= '<option value="" selected>Select Parent</option>';
    foreach ($result as $row) {
        $option .= '<option value="' . $row['Id'] . '">' . $row['Name'] . '</option>';
    }
    echo $option;
}
fetchAllMembers($conn);
