 <?php
    // Connection details
    $host = "localhost";
    $user = "Phionah";
    $pass = "phionah";
    $database = "cattle_trade_hub";

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
 ?>