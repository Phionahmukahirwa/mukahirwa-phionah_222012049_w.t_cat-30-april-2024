 <?php
    // Connection details
    include('db-connection.php');

// Check if Customer_Id is set
if(isset($_REQUEST['CustomerID'])) {
    $Custid = $_REQUEST['CustomerID'];

    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM customers WHERE CustomerID=?");
    $stmt->bind_param("i", $Custid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='customers.PHP'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    } 

    $stmt->close();
} else {
    echo "customer id is not set.";
}

$connection->close();
?>
