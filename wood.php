<?php

include_once('./config.php');

// Use 'Sheet1' or the sheet name; omit the range to get all data
$url = "https://sheets.googleapis.com/v4/spreadsheets/$spreadsheetId/values/Wood?key=$apiKey";

$response = file_get_contents($url);
$data = json_decode($response, true);

$ShowAvgPosts;
if (isset($_COOKIE['avgPosts'])) {
    if ($_COOKIE['avgPosts'] == true) {
        $ShowAvgPosts = $_COOKIE['avgPosts'];
    } else {
        $ShowAvgPosts = $_COOKIE['avgPosts'];
    }
} else {
    $ShowAvgPosts = "false";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wood - LT2 Pricing Sheet</title>

    <link rel="stylesheet" href="./main.css">
</head>
<body>
    <?php include_once('./templates/header.php') ?>
        <?php 

            if (isset($data['values'])) {
                echo "<div id='tableWrapper'><table id='myTable' border='1' style='width:100%;'>";
                
                foreach ($data['values'] as $rowIndex => $row) {

                    if ($rowIndex == 0) {
                        // First row: Use <th> for headers
                        echo "<tr>";
                        foreach ($row as $cellIndex => $cell) {
                            if ($cellIndex <= 2 || $cellIndex == 7) {
                                continue;
                            } 
                            if ($ShowAvgPosts == "false") {
                                if ($cellIndex == 6) {
                                    continue;
                                } else {
                                    echo "<th class='sticky' id='header-$cellIndex'>" . htmlspecialchars($cell) . "</th>";
                                } 
                            } else {
                                echo "<th class='sticky' id='header-$cellIndex'>" . htmlspecialchars($cell) . "</th>";
                            }
                        }
                        echo "</tr>";
                        continue; // Skip to the next iteration after handling the header row
                    }

                    if (count($row) == 1) { // Section headers like "< GENERAL >"
                        if ($ShowAvgPosts == "true") { $rowLength = 4; } else { $rowLength = 3; }
                        echo "<tr><th id='Sectionheader ".htmlspecialchars($row[0])." ".count($row)."' colspan='". $rowLength ."'> ". htmlspecialchars($row[0]) . "</th></tr>";
                        continue;
                    }

                    echo "<tr>";

                    foreach ($row as $cellIndex => $cell) {
                        if ($cellIndex <= 2) {
                            continue;
                        }
                        if ($cellIndex == 7) { // Assume the 8th column contains the image URL
                            continue;
                        }

                        if ($ShowAvgPosts == "false") {
                            if ($cellIndex == 6) {
                                continue;
                            } else {
                                echo "<td id='".$cellIndex."'>" . htmlspecialchars($cell) . "</td>";
                            } 
                        } else {
                            echo "<td id='".$cellIndex."'>" . htmlspecialchars($cell) . "</td>";
                        }
                    }

                    echo "</tr>";

                }
                
                echo "</table></div>";
            } else {
                echo "No data found..";
            }

        ?>

    <?php include_once('./templates/footer.php') ?>
</body>
<script src="./main.js"></script>
</html>