<?php
include '../../PHP/userDB/mysqlConn.php';

if (isset($_GET['id'])) {
    $itemID = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM listdb WHERE id = ?");
    $stmt->bind_param("i", $itemID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($item = $result->fetch_assoc()):

        // Handle reporting
        if (isset($_POST['report_item'])) {
            $reason = htmlspecialchars($_POST['reason']);
            if (!empty($reason)) {
                $stmt_report = $conn->prepare("INSERT INTO reports (item_id, type, reason) VALUES (?, 'item', ?)");
                $stmt_report->bind_param("is", $itemID, $reason);
                if ($stmt_report->execute()) {
                    echo "<script>alert('Item reported successfully.');</script>";
                } else {
                    echo "<script>alert('Error reporting item.');</script>";
                }
                $stmt_report->close();
            } else {
                echo "<script>alert('Please provide a reason for reporting.');</script>";
            }
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matexchange - <?php echo htmlspecialchars($item['title']); ?></title>
    <link rel="stylesheet" href="../../CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php session_start(); ?>
    <Header>
        <div class="navbar navbar-expand">
            <div class="container" id="top-bar">
                <div id="title" class="navbar-brand"> <a href="../../../index.php" class="nav-content">Matexchange</a></div>
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
    <div class="container" id="item-page-container">
        <h1 class="headline"><?php echo htmlspecialchars($item['title']); ?></h1>
        <div class="item-page-block">
            <div class="item-page-content">
                <div class="item-page-image">
                    <img src="../../<?php echo htmlspecialchars($item['itemImage']); ?>" alt="Item Image">
                </div>
                <div class="item-page-description">
                    <div class="item-page-box">
                        <p id="list-page-price">Price: $<?php echo number_format($item['price'], 2); ?></p>
                        <p class="item-page-desc"><?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
                        <p>Posted by: <?php echo htmlspecialchars($item['user']); ?></p>
                        <button class="add-list-btn">Buy</button>
                        <form id="report-form" method="POST" action="" onsubmit="return confirm('Are you sure you want to report this item?');">
                            <textarea name="reason" placeholder="Enter reason for reporting" rows="2" required></textarea>
                            <button type="submit" name="report_item" class="btn btn-danger btn-sm">Report Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../Scripts/main.js"></script>
</body>
</html>
<?php
    else:
        echo "Item not found.";
    endif;
} else {
    echo "No item ID provided.";
}
$conn->close();
?>