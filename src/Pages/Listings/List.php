<?php 
    include "../../PHP/userDB/mysqlConn.php";

    $sqlSelect = "SELECT * FROM listdb ORDER BY created_at DESC";
    $result = $conn ->query($sqlSelect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matexchange</title>
    <link rel="stylesheet" href="../../CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php session_start();?>
    <Header>
        <div class="navbar navbar-expand">
            <div class="container" id="top-bar">
                <div id="title" class="navbar-brand"> <a href="../../index.php" class="nav-content">Matexchange</a></div>
                <div id="menu-btn" class="ribbon-content"><button class="nav-content" id="dropdown-btn">|||</button></div>
            </div>
        </div>
    </Header>
    <div id="display-menu" class="display-menu">
        <a href="../Catagories/Catagories.html" class="menu-links">Catagories</a>
        <a href="../Listings/List.php" class="menu-links">Your Lists</a>
        <a href="../Messages/Messages.php" class="menu-links">Messages</a>
        <a href="../Settings/Settings.html" class="menu-links">Acount settings</a>
        <a href="../About/About.html" class="menu-links">About us</a>
    </div>
    <h1 class="headline"><?php if (isset($_SESSION['username'])): ?><?php echo htmlspecialchars($_SESSION['username'])?>'s Lists<?php else: ?>User List<?php endif; ?></h1>
   <div class="my-lists m-4 " id="items-container">
       <?php while ($row = $result->fetch_assoc()): ?>
           <div class="item-block">
               <div class="item-image">
                   <img src="../../<?php echo htmlspecialchars($row['itemImage']); ?>" alt="Item Image" style="width:100%; max-height:200px; object-fit:cover;">
               </div>
               <div class="item-description">
                    <div class="box">
                        <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p>Price: $<?php echo number_format($row['price'], 2); ?></p>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                    </div>
               </div>
           </div>
       <?php endwhile; ?>
    </div>
        
        <div class="list-add-area">
        <div class="p-2 m-4" id="list-desc">
            <p style="font-size: 23px;">Want to list you handbook or educational material? with the button on the right you can, but do remeber these rules:</p>
            <ul>
                <li>Please only list learning recources!</li>
                <li>No PDF's or any digital versions of books(only list pysical copies)</li>
                <li><font color="red">DO NOT</font> list inapropriate materials, this includes picturs,descriptions and names!</li>
            </ul>
        </div>
        <a href="../extraPages/addList.html" class="add-link"><button id="list-add-btn">List an item</button></a>
    </div>
    <script src="../../Scripts/main.js"></script>
    <script src="../../Scripts/fpage.js"></script>
</body>
</html>