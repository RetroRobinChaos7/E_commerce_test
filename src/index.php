<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matexchange</title>
    <link rel="stylesheet" href="CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <HEADER>
        <div class="navbar navbar-expand">
            <div class="container" id="top-bar">
                <div id="title" class="navbar-brand"> <a href="index.php" class="nav-content">Matexchange</a></div>
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="Pages/Login/login.html" class="nav-content">Login</a></li>
                    <li class="nav-item"><button class="nav-content" id="dropdown-btn">|||</button></li>
                </ul>
            </div>
        </div>     
    </HEADER>
    <div id="display-menu" class="display-menu">
        <a href="Pages/Catagories/Catagories.html" class="menu-links">Catagories</a>
        <a href="Pages/Listings/List.php" class="menu-links">Your Lists</a>
        <a href="Pages/Messages/Messages.php" class="menu-links">Messages</a>
        <a href="Pages/Settings/Settings.html" class="menu-links">Acount settings</a>
        <a href="Pages/About/About.html" class="menu-links">About us</a>
    </div>
    <div class="top-items">
        <div class="item-block">
            <div class="item-image"></div>
            <div class="item-description"></div>
        </div>
        <div class="item-block">
            <div class="item-image"></div>
            <div class="item-description"></div>
        </div>
        <div class="item-block">
            <div class="item-image"></div>
            <div class="item-description"></div>
        </div>
        <div class="item-block">
            <div class="item-image"></div>
            <div class="item-description"></div>
        </div>
    </div>
    <script src="Scripts/main.js"></script>
    <script src="Scripts/fpage.js"></script>
</body>
</html>