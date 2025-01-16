<!DOCTYPE html>
<?php

include_once('./config.php');

// Use 'Sheet1' or the sheet name; omit the range to get all data
$url = "https://sheets.googleapis.com/v4/spreadsheets/$spreadsheetId/values/Welcome?key=$apiKey&range=D24:D25";

$response = file_get_contents($url);
$data = json_decode($response, true);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME - LT2 Pricing Sheet</title>

    <link rel="stylesheet" href="./main.css">
</head>
<body>
    <?php include_once('./templates/header.php') ?>
        
    <h1>LT2 Pricing Sheet Frontend</h1>
    <p>
        Providing an easier to read and use frontend of the Roblox LT2 Pricing Sheet sourced and updated by NightPlayz (nightnike246), Nik (Nikshi), Wolf (Patchz.),
        Aptyn (RandomFlowz) and last but certainly not least, nbds_ (Baguette).  This sheet was last updated <?php echo explode("Refresh updates:",$data['values'][1][0])[1] ?>
        and is reading version <?php echo explode("Current list version:",$data['values'][0][0])[1] ?>. 
        Use the navigation bar at the top of the screen to view different sections and to customize your pricing sheet.
    </p>
    <p style="margin-top: 10px;">
        This website was created by Alec (ScrapBlox) using Google Sheets API.  I created this website because I liked the Google sheet as a source but it can be difficult to read
        especially to those on mobile I also felt it could use some filters.  If you need to contact me for whatever reason feel free to message me on discord (scrapblox)
        or <a href="mailto:scrapblox@gmail.com">scrapblox@gmail.com</a>
    </p>

    <?php include_once('./templates/footer.php') ?>
</body>
<script src="./main.js"></script>

</html>