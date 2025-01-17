<?php

include_once('./config.php');

// Use 'Sheet1' or the sheet name; omit the range to get all data
$url = "https://sheets.googleapis.com/v4/spreadsheets/$spreadsheetId/values/Item?key=$apiKey";

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
    $ShowAvgPosts = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items - LT2 Pricing Sheet</title>
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
                            if ($cellIndex == 0 || $cellIndex == 5 || $cellIndex == 11 || $cellIndex == 17 || $cellIndex == 12 || $cellIndex == 6) {
                                continue;
                            } else {
                                if ($ShowAvgPosts == "false") {
                                    if ($cellIndex == 4 || $cellIndex == 10 || $cellIndex == 16) {
                                        continue;
                                    } else {
                                        echo "<th class='sticky' id='header-$cellIndex'>" . htmlspecialchars($cell) . "</th>";
                                    }
                                } else {
                                    echo "<th class='sticky' id='header-$cellIndex'>" . htmlspecialchars($cell) . "</th>";
                                }
                            }
                        }
                        echo "</tr>";
                        continue; // Skip to the next iteration after handling the header row
                    }
                    if (count($row) == 1) { // Section headers like "< GENERAL >"
                        $rowLength;
                        if ($ShowAvgPosts == "true") { $rowLength = 13; } else { $rowLength = 10; }
                        echo "<tr><th id='Sectionheader ".htmlspecialchars($row[0])." ".count($row)."' colspan='". $rowLength ."'> ". htmlspecialchars($row[0]) . "</th></tr>";
                        continue;
                    }

                    echo "<tr>";

                    foreach ($row as $cellIndex => $cell) {
                        if ($cellIndex == 0 || $cellIndex == 5 || $cellIndex == 11 || $cellIndex == 17 || $cellIndex == 12 || $cellIndex == 6) {
                            continue;
                        } else {
                            if (htmlspecialchars($cell) == "object does not exist in this form" && $cellIndex != 4 && $cellIndex != 10) {
                                echo "<td id='".$cellIndex." blank'></td>";
                                continue;
                            } else {   
                                if ($ShowAvgPosts == "false") {
                                    if ($cellIndex == 4 || $cellIndex == 10 || $cellIndex == 16) {
                                        continue;
                                    } else {
                                        echo "<td id='".$cellIndex."'>" . htmlspecialchars($cell) . "</td>";
                                    }
                                } else {
                                    echo "<td id='".$cellIndex."'>" . htmlspecialchars($cell) . "</td>";
                                }
                            }
                        }
                            // echo "<td id='".$cellIndex."'>" . htmlspecialchars($cell) . "</td>";
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