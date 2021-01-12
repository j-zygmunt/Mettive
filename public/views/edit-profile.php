<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/scrollbarStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/navigationStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/myProfileStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/profilePanel.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6b1d99aa4c.js" crossorigin="anonymous"></script>
    <title>EDIT PROFILE</title>
</head>
<body>
<div class="base-container">
    <nav>
        <?php include("header.php")?>
    </nav>
    <main>
        <section class="profile-panel">
            <img src="public/img/uploads/indeks.jpg">
            <div class="info">
                <div class="stats">
                    <h2>19</h2>
                    <h2>140</h2>
                    <h2>24</h2>
                    <p>meetings</p>
                    <p>followers</p>
                    <p>following</p>
                </div>
                <h2>Name Surname</h2>
            </div>
            <div class="ratings">
                <h2>my ratings</h2>
                <div class="star-rating">
                    langauge
                    <span>★★★★★</span>
                    <br>
                    langauge
                    <span>★★★★★</span>
                    <br>
                    langauge
                    <span>★★★★★</span>
                    <br>
                    langauge
                    <span>★★★★★</span>
                    <br>
                    langauge
                    <span>★★★★★</span>
                    <br>
                    langauge
                    <span>★★★★★</span>
                    <br>
                    langauge
                    <span>★★★★★</span>
                    <br>
                </div>
            </div>

        </section>
        <section class="edit-panel">
            <h1>edit profile</h1>
            <form action="editProfile" enctype="multipart/form-data" method="POST">
                <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message){
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <textarea name="new-about-me" rows="5" placeholder="about me"></textarea>
                <input type="file" accept="image/png, image/jpeg" name='file'><br/>
                <button class="save-profile-button" type="submit">save changes</button>
            </form>
        </section>
        <section class="about-panel">
            <div class="available-dates">
                <h2>my available dates</h2>
                <div class="date">
                    <p>month:day</p>
                    <p>hour-hour</p>
                    <p>month:day</p>
                    <p>hour-hour</p>
                    <p>month:day</p>
                    <p>hour-hour</p>
                    <p>month:day</p>
                    <p>hour-hour</p>
                    <p>month:day</p>
                    <p>hour-hour</p>
                    <p>month:day</p>
                    <p>hour-hour</p>
                    <p>month:day</p>
                    <p>hour-hour</p>
                </div>
                <button class="edit-button">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
            <div class="about-me">
                <h2>about me</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <h2>country, city</h2>
            </div>
        </section>
    </main>
</div>
</body>