<?php
    if (!defined('START'))
        exit('NO DIRECT ACCESS!');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href=<?php echo MEDIA_PATH . "favicon.ico";?>>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'public/css/base.css'; ?>">
    <title>Primus Panel</title>
</head>
<body>
    <nav class="nav">
        <ul class="nav-list">
            <li class="image">
                <img src="<?php echo MEDIA_PATH . "primus_logo.png";?>" alt="primus logo">
                <h1>Primus Panel</h1>
            </li>
            <li class="home">
                <a href="<?php echo BASE_URL; ?>">Home</a>
            </li>
        </ul>
    </nav>
    
