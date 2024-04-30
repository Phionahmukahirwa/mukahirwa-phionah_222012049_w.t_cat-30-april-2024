<?php
// Connection details
include('db-connection.php');

// Check if Payment_Id is set
if(isset($_REQUEST['Payment_id'])) {
    $payid = $_REQUEST['Payment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM payment WHERE Payment_id=?");
    $stmt->bind_param("i", $payid);
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
            <input type="hidden" name="payid" value="<?php echo $payid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='payment.PHP'>OK</a>";
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
    echo " payment id is not set.";
}

$connection->close();
?>
