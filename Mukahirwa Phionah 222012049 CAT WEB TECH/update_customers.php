<?php
// Connection details
include('db-connection.php');

// Check if Customer_Id is set
if(isset($_REQUEST['CustomerID'])) {
    $custid = $_REQUEST['CustomerID'];
    
    $stmt = $connection->prepare("SELECT * FROM customers WHERE CustomerID=?");
    $stmt->bind_param("i", $custid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['CustomerID'];
        $y = $row['Name'];
        $z = $row['Contact'];
        $w = $row['Address'];
    } else {
        echo "customer id not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Form of customer</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of customer form -->
    <h2><u>Update Form of customer</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="custname">Name:</label>
        <input type="text" name="custname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="custcont">Contact:</label>
        <input type="text" name="custcont" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="addrs">Address:</label>
        <input type="text" name="addrs" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $customer_nm = $_POST['custname'];
    $customer_cntct = $_POST['custcont'];
    $cusomer_addrs = $_POST['addrs'];
    
    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE customers SET Name=?, Contact=?, Address=? WHERE CustomerID=?");
    $stmt->bind_param("sssi",$customer_nm, $customer_cntct, $cusomer_addrs, $custid);
    $stmt->execute();
    
    // Redirect to customers.php
    header('Location: customers.PHP');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
