<?php
  include '../../PHP/userDB/mysqlConn.php';

  if (isset($_GET['id'])){
    $itemID = intval($_GET['id']);

    $stmt = $conn->prepare("select * from listdb where id =?");
    $stmt -> bind_param("i",$itemID);
    $stmt -> execute();
    $result = $stmt->get_result();
    if ($item = $result->fetch_assoc()):
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
    <div class="container" id="background-area">
        <h1 class="headline"><?php echo htmlspecialchars($item['title']);?></h1>
        <div>
            <img src="../../<?php echo htmlspecialchars($item['itemImage']); ?>" style="width:300px;height:400px;">
        </div>
        <div>
            <p id="list-page-price">Price: $<?php echo number_format($item['price'], 2); ?></p>
            <p><?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
            <button class="add-list-btn">Buy</button>
        </div>
    </div>
</body>
</html>
<?php
    else:
        echo "Item not found.";
    endif;
} else {
    echo "No item ID provided.";
}
?>