<?php
// 404.php - Custom 404 Error Page

// Set the HTTP response code to 404
http_response_code(404);

// Set the page title
$pageTitle = "Page Not Found";

// Include header (if you have one)
//include 'includes/header.php'; // Example: Include your header file

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding-top: 50px;
        }

        h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }

        a {
            color: blue;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <h1>404 - Page Not Found</h1>
    <p>The page you requested could not be found.</p>
    <p>Please check the URL or return to the <a href="/">homepage</a>.</p>

</body>

</html>

<?php
error_log("404 Error: " . $_SERVER['REQUEST_URI'] . " from " . $_SERVER['REMOTE_ADDR']);


// include 'includes/footer.php'; 
?>