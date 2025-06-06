<?php session_start(); ?>
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
    <div class="navbar navbar-expand">
        <div class="container" id="top-bar">
            <div id="title" class="navbar-brand"> <a href="../../../index.php" class="nav-content">Matexchange</a></div>
            <ul class="navbar-nav">
                <li class="nav-item"><button class="nav-content" id="dropdown-btn">|||</button></li>
            </ul>
        </div>
    </div>
    <div id="display-menu" class="display-menu">
        <a href="../Catagories/Catagories.html" class="menu-links">Catagories</a>
        <a href="../Listings/List.php" class="menu-links">Your Lists</a>
        <a href="../Messages/Messages.php" class="menu-links">Messages</a>
        <a href="../Settings/Settings.html" class="menu-links">Acount settings</a>
        <a href="../About/About.html" class="menu-links">About us</a>
    </div>
    <div id="top-mylist">
        <a href="../../Pages/Listings/List.php"><button id="list-add-btn">&#8592;</button></a>
        <h1 class="headline">Fill in you listings info</h1>
    </div>
    <div class="container">
        <div class="box p-2" id="add-section">
            <form action="../../PHP/add.php" enctype="multipart/form-data" method="POST" id="list-form" class="box p-3">
                <div class="add-section-box p-1">
                    <div class="info-box">
                        <label for="title" class="list-add-first">Title: </label><br>
                        <input class="list-add-first" type="text" name="title" style="border: solid black 2px" required><br>
                        <label class="list-add-first" for="price">Price: </label><br>
                        <div class="input-group" id="inp-price">
                            <div class="input-group-text" style="border: solid black 2px">R</div>
                            <input type="number" name="price" min="0" max="9999999" style="width: 75%; border: solid black 2px"><br>
                        </div>
                        <label for="inp-cat" class="list-add-first">Catagories:</label><br>
                        <div class="row" style="justify-content: center;">
                            <div class="col col-3 m-2">
                                <div>
                                    <label for="it" id="inp-boxes">IT</label>
                                    <input type="checkbox" name="cat" id="inp-boxes" value="it">
                                </div>
                                <div>
                                    <label for="it" id="inp-boxes">Law</label>
                                    <input type="checkbox" name="cat" id="inp-boxes" value="law">
                                </div>
                                <div>
                                    <label for="it" id="inp-boxes">Science</label>
                                    <input type="checkbox" name="cat" id="inp-boxes" value="science">
                                </div>
                            </div>
                            <div class="col col-3 m-2">
                                <div>
                                    <label for="it" id="inp-boxes">Math</label>
                                    <input type="checkbox" name="cat" id="inp-boxes" value="math">
                                </div>
                                <div>
                                    <label for="it" id="inp-boxes">Humanities</label>
                                    <input type="checkbox" name="cat" id="inp-boxes" value="humanities">
                                </div>
                                <div>
                                    <label for="it" id="inp-boxes">Medical</label>
                                    <input type="checkbox" name="cat" id="inp-boxes" value="medical">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-box">
                        <label for="desc" class="list-add-first">Description: </label><br>  
                            <textarea class="list-textarea" name="desc" maxlength="200" placeholder="A Brief descriptionof you listing."></textarea>
                    </div>
                </div>
                <div class="add-section-box p-1" id="right-add">
                    <label for="pic" class="list-add-first">Item Picture:</label><br>
                    <div id="img-section">
                        <div class="img-place"><img id="preview-img" alt="Item Image"></div>
                        <div class="btn-selector">
                            <input type="file" accept=".png,.jpg" id="img-select" name="listImg">
                            <input type="submit" id="list-add-btn">
                        </div>
                    </div>            
                </div>
            </form>
        </div>
    </div>
    <script src="../../Scripts/main.js"></script>
    <script src="../../Scripts/image.js"></script>
</body>
</html>