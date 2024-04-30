<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Connection details
    include('db-connection.php');


    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'animals_available' => "SELECT animal_name FROM animals_available WHERE animal_name LIKE '%$searchTerm%'",
        'customers' => "SELECT Name FROM customers WHERE Name LIKE '%$searchTerm%'",
        'farmer' => "SELECT FarmerID FROM farmer WHERE FarmerID LIKE '%$searchTerm%'",
        'Transaction' => "SELECT TransactionType FROM Transaction WHERE TransactionType LIKE '%$searchTerm%'",
        'payment' => "SELECT Payment_method FROM payment WHERE Payment_method LIKE '%$searchTerm%'",
    ];

      // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
