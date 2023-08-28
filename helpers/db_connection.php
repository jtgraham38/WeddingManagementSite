<?php
// Create a database connection
function query($sql, $args=[]){
    //create db connection
    $connection = new mysqli("mariadb", "wedding", "Liplik_134", "wedding");

    //check connection...
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    //check if it is a select statment
    $is_select = preg_match('/^\s*SELECT/i', $sql);

    //if there are arguments
    if (!empty($args)){
        $stmt = $connection->prepare($sql);
        if (!$stmt){
            die("Query preparation failed: " . $connection->error);
        }

        //bind params
        $types = str_repeat("s", count($args)); //assuming all values are strings
        $stmt->bind_param($types, ...$args);

        //execute the prepared statement
        if (!$stmt->execute()) {
            die("Query execution failed: " . $stmt->error);
        }

        //get result
        $result = $stmt->get_result();
        
        //close the statement
        $stmt->close();
    } else{

        //get results
        $result = $connection->query($sql);

        //close the connection and return results if it was a select statement
        $connection->close();
    }

   
    if ($result){

        $return = [];
        while ($row = $result->fetch_assoc()) {
            array_push($return, $row);
        }

        //return values if necessary
        if ($is_select && $return){
            return $return;
        }
    }
}

/*
EXAMPLE OF EXTRACTOING RESULTS
<h1>Database Data</h1>
    <ul>
        <?php
        // Display fetched data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row["test1"] . "</li>";
            }
        } else {
            echo "<li>No data available</li>";
        }
        ?>
    </ul>
*/

?>