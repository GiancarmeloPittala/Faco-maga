<?php

include 'ConnDB.php';

$sql = "SELECT COD,DESCR FROM 01_desvar where tipo = 'D';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value=". $row["COD"].">". $row["DESCR"]." </option>";
    }
} else {
    echo "0 results SectionCat";
}

$conn->close();


?>