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
            <?php include("profile-panel.php")?>
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
                <h2>reviews</h2>
            </div>
            <?php foreach ($reviews as $review): ?>
                <?php include("review.php")?>
            <?php endforeach; ?>
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