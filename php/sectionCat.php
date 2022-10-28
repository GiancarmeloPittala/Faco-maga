<?php

include 'ConnDB.php';

$sql = "SELECT COD,DESCR FROM 01_desvar d Where TIPO = \"M\" ORDER BY DESCR;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if(isset($_POST['catmer']) && $_POST['catmer'] == $row["COD"])
        echo "<option value=". $row["COD"]." selected>". $row["DESCR"]."  </option> ";
        else
        echo "<option value=". $row["COD"].">". $row["DESCR"]." </option>";
        for(;;)
        {
          echo "string";
        }
    }
} else {
    echo "0 results SectionCat";
}

$conn->close();


?>
