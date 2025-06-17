<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matexchange</title>
    <link rel="stylesheet" href="src/CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body><?php ini_set('session.cookie_lifetime', 0);  session_start();?>
    <HEADER>
    <div class="navbar navbar-expand">
        <div class="container" id="top-bar">
            <div id="title" class="navbar-brand">
                <a href="index.php" class="nav-content">Matexchange</a>
            </div>
            <ul class="navbar-nav align-items-center">
                <form class="d-flex me-3" action="src/Pages/Search/search.php" method="GET" role="search">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search items..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">&#128269;</button>
                </form>
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a href="src/Pages/Profile/profile.php" class="nav-content">
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="src/Pages/Login/login.html" class="nav-content">Login</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item"><button class="nav-content" id="dropdown-btn">|||</button></li>
            </ul>
        </div>
    </div>
</HEADER>
    <div id="display-menu" class="display-menu">
    <a href="src/Pages/Catagories/Catagories.html" class="menu-links">Catagories</a>
    <a href="src/Pages/Listings/List.php" class="menu-links">Your Lists</a>
    <a href="src/Pages/Messages/Messages.php" class="menu-links">Messages</a>
    <a href="src/Pages/Settings/Settings.html" class="menu-links">Acount settings</a>
    <a href="src/Pages/About/About.html" class="menu-links">About us</a>
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
        <a href="src/Pages/Admin/admin.php" class="menu-links">Admin Panel</a>
    <?php endif; ?>
    </div>
    <div class="container">
        <?php
        include 'src/PHP/userDB/mysqlConn.php';
        $stmt = $conn->prepare("SELECT * FROM listdb ORDER BY created_at DESC LIMIT 3");
        $stmt->execute();
        $result = $stmt->get_result();
        ?>
        <div class="my-lists-offshoot" id="index-top" style="height: 400px; margin-top: 70px;">
            <div class="index-block" id="index-block-left">
                <div id="index-block-desc">
                    <div class="border-box" id="border-box-left">
                        <p id="made-easy">Do it</p>
                        <div ><hr class="inner-hr"></div>
                        <p id="made-easy">Simple</p>
                        <div><hr class="inner-hr"></div>
                        <p id="made-easy">With</p>
                        <div><hr class="inner-hr"></div>
                        <p class="matexchange">Matexchange</p>
                    </div>
                </div>
            </div>
            <div class="index-block" id="index-block-right">
                <div id="index-block-desc">
                    <div class="border-box" id="border-box-right">
                        <p class="index-top-desc">Do you need to sell you handbook?</p>
                        <p class="index-top-desc">Are the regular platforms just not yielding results?</p>
                        <div class="dot"></div>
                        <p class="index-top-desc">Well look no further.</p>
                        <p class="index-top-desc">With Matexchange you can broaden your reach.</p>
                    </div>
                </div>   
            </div>
        </div>
        <h2 class="headline" style="margin-top: 20px;">Recently Added Items</h2>
        <div class="my-lists m-4" id="top-items-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="item-block" data-id="<?php echo $row['id'];?>">
                    <div class="item-image">
                        <img class="list-image" src="src/<?php echo htmlspecialchars($row['itemImage']); ?>" alt="Item Image" style="width:100%; max-height:200px; object-fit:cover;">
                    </div>
                    <div class="item-description">
                        <div class="box">
                            <h5 class="list-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p>Price: $<?php echo number_format($row['price'], 2); ?></p>
                            <p class="list-ini-desc"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p>Posted by: <?php echo htmlspecialchars($row['user']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php $conn->close(); ?>
        </div>  
    </div>
    <footer class="text-center text-lg-start mt-5" style="border-top: 1px solid black; padding: 20px 0;background-color:rgb(38, 50, 59);">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-2 mb-md-0 text-light">
                <span class="fw-bold">Matexchange</span> &copy; <?php echo date('Y'); ?>. All rights reserved.
            </div>
            <div><a href="#">about</a></div>
        </div>
    </footer>
    <script src="src/Scripts/main.js"></script>
    <script src="src/Scripts/fpage.js"></script>
</body>
</html>