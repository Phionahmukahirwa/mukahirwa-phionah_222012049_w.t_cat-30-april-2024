 <?php
    // Connection details
    include('db-connection.php');

// Check if Farmer_Id is set
if(isset($_REQUEST['FarmerID'])) {
    $farmid = $_REQUEST['FarmerID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM farmer WHERE FarmerID=?");

    $stmt->bind_param("i",$farmid);
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
            <input type="hidden" name="farmid" value="<?php echo $farmid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='farmer.PHP'>OK</a>";
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
    echo "farmer id is not set.";
}

$connection->close();
?>
