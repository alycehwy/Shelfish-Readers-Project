<?php
include './config.php';
//"localhost"
//"root"
//""
//shelfishrd_db
                                                        session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $b_id = $_POST['b_id'];
    $updateCmd = "UPDATE books_tb SET b_likes = b_likes+1 WHERE b_id = $b_id";
    $dbConection->query($updateCmd);


    $selectCmd = "SELECT * FROM books_tb ";
    $result = $dbConection->query($selectCmd);

    if ($result->num_rows > 0) {
        echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'><table border='3'><thead><tr><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['b_title'] . "</br>By: " . $row['b_author'] . "</td>";
            echo "<td>" . $row['b_description'] . "</td>";
            echo "<td>" . $row['b_price'] . "CAD</td>";
            echo "<td>" . $row['b_likes'] . "<button type='submit' name='b_id' value='". $row['b_id'] . "'>like</button></td></tr>";
        }
        echo "</tbody></table></form>";
    }
} else {
    $dbConection = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);

    // $_SESSION['b_id'] = $_GET['b_id'];
    // $b_idd = $_SESSION['b_id'];

    // $updateCmd = "UPDATE books_tb SET b_likes = b_likes-1 WHERE b_id = $b_idd";
    // $dbConection->query($updateCmd);

    if ($dbConection->connect_error) {
        die("Conection Error"); //page 404
    } else {
        $selectCmd = "SELECT * FROM books_tb ";
        $result = $dbConection->query($selectCmd);

        if ($result->num_rows > 0) {
            echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'><table border='3'><thead><tr><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th></tr></thead><tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['b_title'] . "</br>By: " . $row['b_author'] . "</td>";
            echo "<td>" . $row['b_description'] . "</td>";
            echo "<td>" . $row['b_price'] . "CAD</td>";
            echo "<td>" . $row['b_likes'] . "<button type='submit' name='b_id' value='". $row['b_id'] . "'>like</button></td></tr>";
            }
            echo "</tbody></table></form>";
        }
    }
}
