 <?php
    // Connection details
    include('db-connection.php');

// Check if animal_Id is set
if(isset($_REQUEST['animal_id'])) {
    $availid = $_REQUEST['animal_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM animals_available WHERE animal_id=?");

    $stmt->bind_param("i",$availid);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="availid" value="<?php echo $availid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='animals_available.PHP'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    } 
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "animal id is not set.";
}

$connection->close();
?>
