<?php 
    session_start();
    if (!isset($_SESSION['username'])) {
    header("Location: ../Login/login.html");
    exit(); 
    }
    include "../../PHP/userDB/mysqlConn.php";

    $query = isset($_GET['query']) ? trim($_GET['query']) : '';
    $results = [];

    if ($query !== '') {
    $stmt = $conn->prepare("SELECT * FROM listdb WHERE title LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $results = $stmt->get_result();
    }
?>
<script>

    let counter = 0;

</script>
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
    <HEADER>
    <div class="navbar navbar-expand">
        <div class="container" id="top-bar">
            <div id="title" class="navbar-brand">
                <a href="../../../index.php" class="nav-content">Matexchange</a>
            </div>
            <ul class="navbar-nav align-items-center">
                <form class="d-flex me-3" action="search.php" method="GET" role="search" style="margin-bottom: 0px;">
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
        <a href="../Catagories/Catagories.html" class="menu-links">Catagories</a>
        <a href="../Listings/List.php" class="menu-links">Your Lists</a>
        <a href="../Messages/Messages.php" class="menu-links">Messages</a>
        <a href="../Settings/Settings.html" class="menu-links">Acount settings</a>
        <a href="../About/About.html" class="menu-links">About us</a>
    </div>
    <h1 class="headline">Results for <?php if (isset($_SESSION['username'])): ?><?php echo htmlspecialchars($query)?><?php else: ?>User List<?php endif; ?></h1>
    <div class="container">
        <div class="my-lists m-4 " id="items-container">
            <?php if ($results && $results->num_rows > 0): ?>
                <?php while ($row = $results->fetch_assoc()): ?>
                    <div class="item-block" data-id="<?php echo $row['id'];?>">
                    <div class="item-image">
                        <img class="list-image" src="../../<?php echo htmlspecialchars($row['itemImage']); ?>" alt="Item Image" style="width:100%; max-height:200px; object-fit:cover;">
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
        <?php else: ?>
            <p>No items found.</p>
        <?php endif; ?>
        </div>
    </div>
    <script src="../../Scripts/main.js"></script>
    <script src="../../Scripts/fpage.js"></script>
</body>
</html>