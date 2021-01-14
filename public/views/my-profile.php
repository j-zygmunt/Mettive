<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/scrollbarStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/navigationStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/myProfileStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/profilePanel.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6b1d99aa4c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/myProfile.js" defer></script>
    <title>MY PROFILE</title>
</head>
<body>
<div class="base-container">
    <nav>
        <?php include("header.php")?>
    </nav>
    <main>
        <section class="profile-panel">
            <img src="public/uploads/<?= $userProfile->getPhoto()?>">
            <div class="info">
                <div class="stats">
                    <h2>19</h2>
                    <h2><?= $userProfile->getFollowersAmount()?></h2>
                    <h2><?= $userProfile->getFollowingAmount()?></h2>
                    <p>meetings</p>
                    <p>followers</p>
                    <p>following</p>
                </div>
                <h2><?= $userProfile->getName()?> <?= $userProfile->getSurname()?></h2>
                <h2><?= $userProfile->getEmail()?></h2>
            </div>
            <div class="ratings">
                <h2>my rating</h2>
                <div class="star-rating">
                    <?= $userProfile->getMainLanguage()?>
                    <span>★★★★★</span>
                    <br>
                </div>
            </div>
            <button class="edit-profile-button" type="submit">edit profile</button>
        </section>
        <section class="messages-panel">
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $message){
                        echo $message;
                    }
                }
                ?>
            </div>
            <div class="header">
                <h2>messages</h2>
            </div>
            <div class="message-1">
                <div class="msginfo">
                    <div class="sender-info">
                        <p>22 11 2020</p>
                        <h2>Name Surname</h2>
                    </div>
                    <img src="public/img/uploads/indeks.jpg">
                </div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <button class="reply-button">
                    <i class="fas fa-reply"></i>
                </button>
            </div>
            <div class="message-1">
                <div class="msginfo">
                    <div class="sender-info">
                        <p>22 11 2020</p>
                        <h2>Name Surname</h2>
                    </div>
                    <img src="public/img/uploads/indeks.jpg">
                </div>
                <p>
                    Lorem orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <button class="reply-button">
                    <i class="fas fa-reply"></i>
                </button>
            </div>
            <div class="message-1">
                <div class="msginfo">
                    <div class="sender-info">
                        <p>22 11 2020</p>
                        <h2>Name Surname</h2>
                    </div>
                    <img src="public/img/uploads/indeks.jpg">
                </div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    t laborum.
                </p>
                <button class="reply-button">
                    <i class="fas fa-reply"></i>
                </button>
            </div>
            <div class="message-1">
                <div class="msginfo">
                    <div class="sender-info">
                        <p>22 11 2020</p>
                        <h2>Name Surname</h2>
                    </div>
                    <img src="public/img/uploads/indeks.jpg">
                </div>
                <p>
                    aute irure dolor in reprehenderit in voluptate velit esse
                </p>
                <button class="reply-button">
                    <i class="fas fa-reply"></i>
                </button>
            </div>
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
            </div>
            <div class="about-me">
                <h2>about me</h2>
                <p>
                    <?= $userProfile->getAboutMe()?>
                </p>
                <h2><?= $userProfile->getCountry(); ?>, <?= $userProfile->getCity(); ?></h2>
            </div>
        </section>
    </main>
</div>
</body>