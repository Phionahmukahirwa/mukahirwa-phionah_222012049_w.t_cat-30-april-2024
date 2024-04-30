 <?php
    // Connection details
    include('db-connection.php');

// Check if cattle_Id is set
if(isset($_REQUEST['CattleID'])) {
    $Cattid = $_REQUEST['CattleID'];

    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM cattle WHERE CattleID=?");
    $stmt->bind_param("i", $Cattid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='cattle.PHP'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    } 

    $stmt->close();
} else {
    echo "cattle id is not set.";
}

$connection->close();
?>
