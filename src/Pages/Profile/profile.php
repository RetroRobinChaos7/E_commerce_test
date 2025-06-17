<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matexchange</title>
    <link rel="stylesheet" href="../../CSS/main.css">
    <link rel="stylesheet" href="../../CSS/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php session_start(); ?>
    <?php 
        if (isset($_POST['logout'])){
            session_unset();
            session_destroy();
            header('Location: ../../../index.php');
            exit();
        }
    ?>
    <a href="index.php" class="text-dark" style="text-decoration: none;"><button id="list-add-btn">&#8592;</button></a>
    <div class="container">
        <form method="POST">
        <div class="row">
            <div class="col">
                <div class="circle"><button class="circle-button" id="circle-replace"></button></div>
                <p>Welcome <?php echo htmlspecialchars($_SESSION['username'])?>!</p>
                <button type="submit" name="logout" id="list-add-btn">Logout</button>
                <div class="textarea-section">
                    <p>Bio</p>
                    <textarea class="textarea-bio"></textarea>
                </div>
            </div>
        </div>
        </form>
        <a href="../Settings/Settings.html"><button name="Acount-Options" id="list-add-btn">Acount Settings</button></a>
    </div>
</body>
</html>