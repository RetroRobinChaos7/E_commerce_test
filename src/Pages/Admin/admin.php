<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../../PHP/userDB/mysqlConn.php");

// Debug session variables
error_log("Session data: " . print_r($_SESSION, true));

// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "<script>alert('You must be an admin to access this page. Session username: " . (isset($_SESSION['username']) ? $_SESSION['username'] : 'not set') . ", is_admin: " . (isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : 'not set') . "'); window.location.href='../../../index.php';</script>";
    exit();
}

// Handle user deletion
if (isset($_POST['delete_user']) && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    echo $stmt->execute()
        ? "<script>alert('User deleted successfully.');</script>"
        : "<script>alert('Error deleting user.');</script>";
    $stmt->close();
}

// Handle item deletion
if (isset($_POST['delete_item']) && isset($_POST['item_id'])) {
    $item_id = intval($_POST['item_id']);
    $stmt = $conn->prepare("DELETE FROM listdb WHERE id = ?");
    $stmt->bind_param("i", $item_id);
    echo $stmt->execute()
        ? "<script>alert('Item deleted successfully.');</script>"
        : "<script>alert('Error deleting item.');</script>";
    $stmt->close();
}

// Search users
$search_results = [];
if (isset($_POST['search_user']) && !empty($_POST['search_term'])) {
    $search_term = htmlspecialchars($_POST['search_term']);
    $stmt = $conn->prepare("SELECT id, username, email FROM users WHERE username LIKE ? OR email LIKE ?");
    $search_param = "%$search_term%";
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $search_results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Fetch reported users
$reported_users = [];
$stmt = $conn->prepare("SELECT r.id, r.user_id, r.reason, u.username, u.email 
                        FROM reports r 
                        JOIN users u ON r.user_id = u.id 
                        WHERE r.type = 'user'");
if ($stmt) {
    $stmt->execute();
    $reported_users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Fetch reported items
$reported_items = [];
$stmt = $conn->prepare("SELECT r.id, r.item_id, r.reason, l.title, l.user, l.itemImage 
                        FROM reports r 
                        JOIN listdb l ON r.item_id = l.id 
                        WHERE r.type = 'item'");
if ($stmt) {
    $stmt->execute();
    $reported_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matexchange - Admin Panel</title>
    <link rel="stylesheet" href="../../CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header>
        <div class="navbar navbar-expand">
            <div class="container" id="top-bar">
                <div id="title" class="navbar-brand"><a href="../../../index.php" class="nav-content">Matexchange</a></div>
                <div id="menu-btn" class="ribbon-content"><button class="nav-content" id="dropdown-btn">|||</button></div>
            </div>
        </div>
    </header>

    <div id="display-menu" class="display-menu">
        <a href="../Catagories/Catagories.html" class="menu-links">Categories</a>
        <a href="../Listings/List.php" class="menu-links">Your Lists</a>
        <a href="../Messages/Messages.php" class="menu-links">Messages</a>
        <a href="../Settings/Settings.html" class="menu-links">Account Settings</a>
        <a href="../About/About.html" class="menu-links">About Us</a>
        <?php if ($_SESSION['is_admin'] == 1): ?>
            <a href="admin.php" class="menu-links">Admin Panel</a>
        <?php endif; ?>
    </div>

    <h1 class="headline">Admin Panel</h1>

    <!-- User Search -->
    <div id="search-form">
        <form method="POST" class="mb-3">
            <div class="input-group">
                <input type="text" name="search_term" class="form-control" placeholder="Search by username or email" required>
                <button type="submit" name="search_user" class="btn btn-primary">Search</button>
            </div>
        </form>
        <?php if (!empty($search_results)): ?>
            <div class="my-lists">
                <?php foreach ($search_results as $user): ?>
                    <div class="item-block">
                        <div class="item-description">
                            <div class="box">
                                <h5 class="list-title"><?= htmlspecialchars($user['username']) ?></h5>
                                <p>Email: <?= htmlspecialchars($user['email']) ?></p>
                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (isset($_POST['search_user'])): ?>
            <p class="text-center text-light">No users found.</p>
        <?php endif; ?>
    </div>

    <!-- Reported Users -->
    <h2 class="headline mt-4">Reported Users</h2>
    <div class="my-lists">
        <?php if (!empty($reported_users)): ?>
            <?php foreach ($reported_users as $report): ?>
                <div class="item-block">
                    <div class="item-description">
                        <div class="box">
                            <h5 class="list-title"><?= htmlspecialchars($report['username']) ?></h5>
                            <p>Email: <?= htmlspecialchars($report['email']) ?></p>
                            <p>Reason: <?= htmlspecialchars($report['reason']) ?></p>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <input type="hidden" name="user_id" value="<?= $report['user_id'] ?>">
                                <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-light">No reported users.</p>
        <?php endif; ?>
    </div>

    <!-- Reported Items -->
    <h2 class="headline mt-4">Reported Items</h2>
    <div class="my-lists">
        <?php if (!empty($reported_items)): ?>
            <?php foreach ($reported_items as $report): ?>
                <div class="item-block">
                    <div class="item-image">
                        <img class="list-image" src="../../<?= htmlspecialchars($report['itemImage']) ?>" alt="Item Image" style="width:100%; max-height:200px; object-fit:cover;">
                    </div>
                    <div class="item-description">
                        <div class="box">
                            <h5 class="list-title"><?= htmlspecialchars($report['title']) ?></h5>
                            <p>Seller: <?= htmlspecialchars($report['user']) ?></p>
                            <p>Reason: <?= htmlspecialchars($report['reason']) ?></p>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                <input type="hidden" name="item_id" value="<?= $report['item_id'] ?>">
                                <button type="submit" name="delete_item" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-light">No reported items.</p>
        <?php endif; ?>
    </div>

    <script src="../../Scripts/main.js"></script>
</body>
</html>
<?php $conn->close(); ?>