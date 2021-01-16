<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/scrollbarStyle.css">
    <link rel="stylesheet" type="text/css" href="/public/css/navigationStyle.css">
    <link rel="stylesheet" type="text/css" href="/public/css/profileStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6b1d99aa4c.js" crossorigin="anonymous"></script>
    <title>PROFILE</title>
</head>
<body>
<div class="base-container">
    <nav>
        <?php include("header.php")?>
    </nav>
    <main>
        <section class="ratings-panel">
            <div class="reviews">
                <div class="rating">
                    <div class="info">
                        <div>
                            <p>22,11,2020</p>
                            <h2>Name Surname</h2>
                        </div>
                        <img src="/public/img/uploads/indeks.jpg">
                    </div>
                    <div class="message">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                    <p>rate: <span>★★★★★</span></p>
                </div>
                <div class="rating">
                    <div class="info">
                        <div>
                            <p>22,11,2020</p>
                            <h2>Name Surname</h2>
                        </div>
                        <img src="/public/img/uploads/indeks.jpg">
                    </div>
                    <div class="message">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                    <p>rate: <span>★★★★★</span></p>
                </div>
                <div class="rating">
                    <div class="info">
                        <div>
                            <p>22,11,2020</p>
                            <h2>Name Surname</h2>
                        </div>
                        <img src="/public/img/uploads/indeks.jpg">
                    </div>
                    <div class="message">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                    <p>rate: <span>★★★★★</span></p>
                </div>
                <div class="rating">
                    <div class="info">
                        <div>
                            <p>22,11,2020</p>
                            <h2>Name Surname</h2>
                        </div>
                        <img src="/public/img/uploads/indeks.jpg">
                    </div>
                    <div class="message">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                    <p>rate: <span>★★★★★</span></p>
                </div>
                <div class="rating">
                    <div class="info">
                        <div>
                            <p>22,11,2020</p>
                            <h2>Name Surname</h2>
                        </div>
                        <img src="/public/img/uploads/indeks.jpg">
                    </div>
                    <div class="message">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                    <p>rate: <span>★★★★★</span></p>
                </div>
                <div class="rating">
                    <div class="info">
                        <div>
                            <p>22,11,2020</p>
                            <h2>Name Surname</h2>
                        </div>
                        <img src="/public/img/uploads/indeks.jpg">
                    </div>
                    <div class="message">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                    <p>rate: <span>★★★★★</span></p>
                </div>
                <div class="rating">
                    <div class="info">
                        <div>
                            <p>22,11,2020</p>
                            <h2>Name Surname</h2>
                        </div>
                        <img src="/public/img/uploads/indeks.jpg">
                    </div>
                    <div class="message">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua.
                        </p>
                    </div>
                    <p>rate: <span>★★★★★</span></p>
                </div>
            </div>
        </section>
        <section class="about-panel">
            <div class="about-me">
                <h2>about <?=$profile->getName()?> <?=$profile->getSurname()?></h2>
                <p><?=$profile->getAboutMe()?></p>
                <h2><?=$profile->getCountry()?>, <?=$profile->getCity()?></h2>
                <h2><?=$profile->getEmail()?></h2>
            </div>
            <div class="user">
                <img src="/public/uploads/<?=$profile->getPhoto()?>">
                <div class="buttons">
                    <button class="message-button">
                        <i class="fas fa-envelope"></i>
                    </button>
                    <button class="rate-button">rate</button>
                    <button class="follow-button">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="user-info">
                <h2>stats</h2>
                <div class="star-rating">
                    <?= $profile->getMainLanguage()?>
                    <span>★★★★★</span>
                </div>
                <div class="stats">
                    <h2><?= $stats->getReviewsAmount()?></h2>
                    <h2><?= $stats->getFollowersAmount()?></h2>
                    <h2><?= $stats->getFollowingAmount()?></h2>
                    <p>meetings</p>
                    <p>followers</p>
                    <p>following</p>
                </div>
                <p>meettive user since: <?= $stats->getCreatedAt()?></p>
            </div>
            <div class="available-dates">
                <h2>available dates</h2>
                <div class="dates">
                    <p>month:day    hour-hour</p>
                    <p>month:day    hour-hour</p>
                    <p>month:day    hour-hour</p>
                    <p>month:day    hour-hour</p>
                    <p>month:day    hour-hour</p>
                    <p>month:day    hour-hour</p>
                </div>
            </div>
        </section>
    </main>
</div>
</body>