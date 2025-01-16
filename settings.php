
<!DOCTYPE html>
<?php

// Make sure no output has been sent before calling setcookie
if (headers_sent()) {
    die("Headers already sent. Cannot set cookie.");
}

$StickyNavCookie = "sticky";
$AveragePostsCookie = "avgPosts";
$StickyNavCookieValue = isset($_COOKIE[$StickyNavCookie]) ? $_COOKIE[$StickyNavCookie] : '';

$AveragePostsCookieValue = isset($_COOKIE[$AveragePostsCookie]) ? $_COOKIE[$AveragePostsCookie] : '';

if (isset($_POST['saveCookies'])) {
    $stickyNav = isset($_POST['stickyBox']) ? 'true' : 'false';
    $avgPosts = isset($_POST['avgPosts']) ? 'true' : 'false';

    // Debug: Output the form data
    var_dump($_POST);
    
    // Set the cookie with an expiration time of 30 days
    if (setcookie($StickyNavCookie, $stickyNav, time() + (86400 * 365), "/", "", isset($_SERVER['HTTPS']), true)) {
        if (setcookie($AveragePostsCookie, $avgPosts, time() + (86400 * 365), "/", "", isset($_SERVER['HTTPS']), true)) {
            echo "Cookie updated to: $stickyNav"; // Show the updated value to the user
        }
    } else {
        echo "Error setting cookie.";
    }

    // Reload the page after setting the cookie
    header("Refresh:0"); // Refresh the page to apply the new cookie
    exit(); // Prevent further execution after setting cookie
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - LT2 Pricing Sheet</title>

    <link rel="stylesheet" href="./main.css">
</head>
<body>
    <?php include_once('./templates/header.php') ?>
        
    <h1>Settings</h1>
    <form method="POST">
        <label>
            <input type="checkbox" name="stickyBox" value="1" 
                <?php if ($StickyNavCookieValue === 'true') echo 'checked'; ?>>
            Enable Sticky Navigation
        </label>
        <br>
        <label>
            <input type="checkbox" name="avgPosts" value="1" 
                <?php if ($AveragePostsCookieValue === 'true') echo 'checked'; ?>>
            Show average posts column
        </label>

        <br><button type="submit" name="saveCookies">Save Preferences</button>
    </form>


    <?php include_once('./templates/footer.php') ?>
</body>
<script src="./main.js"></script>

</html>