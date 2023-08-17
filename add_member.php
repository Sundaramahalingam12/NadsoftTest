<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    include_once 'dbConfig.php';

    $name = $_POST['name'];
    $date = date('Y-m-d H:i:s');
    $parentId = NULL;
    if (!empty($_POST['parentId'])) {
        $parentId = $_POST['parentId'];
    }
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO members (Name, CreatedDate, ParentId) VALUES (:name, :date, :parentId )";
        // Prepare and execute the query
        $statement = $conn->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':date', $date);
        $statement->bindParam(':parentId', $parentId);
        $statement->execute();
        echo 'success';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
