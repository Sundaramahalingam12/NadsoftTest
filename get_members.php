<?php
// Database connection
include_once 'dbConfig.php'; 


function fetchMembers($parentId, $conn) {

    if($parentId==0){
        $query = "SELECT * FROM Members WHERE ParentId IS NULL";
    }else{
        $query = "SELECT * FROM Members WHERE ParentId = $parentId";
    }

    $statement = $conn->prepare($query);
    $statement->execute();

    // Fetch all rows as associative arrays
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        echo '<ul>';
        foreach ($result as $row) {
            echo '<li>' . $row['Name'];
            fetchMembers($row['Id'], $conn);
            echo '</li>';
        }
        echo '</ul>';
    }
fetchMembers(0, $conn);

?>
