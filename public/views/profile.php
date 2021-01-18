<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/scrollbarStyle.css">
    <link rel="stylesheet" type="text/css" href="/public/css/navigationStyle.css">
    <link rel="stylesheet" type="text/css" href="/public/css/profileStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6b1d99aa4c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/./public/js/follow.js" defer></script>
    <script type="text/javascript" src="/./public/js/review.js" defer></script>
    <title>PROFILE</title>
</head>
<body>
<div class="base-container">
    <nav>
        <?php include("header.php")?>
    </nav>
    <main>
        <section class="ratings-panel">
            <div class="header">
                <h2>reviews</h2>
            </div>
            <div class="reviews">
                <?php foreach ($reviews as $review): ?>
                    <?php include("review.php")?>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="about-panel" id=<?= $profile->getId()?>>
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
                    <button class="follow-button" value="<?= $profile->getIsFriend()?>">
                        <i id="follow" class="fas fa-plus-circle"></i>
                        <i id="unfollow" class="fas fa-minus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="user-info">
                <h2>stats</h2>
                <div class="star-rating">
                    <?= $profile->getMainLanguage()?>
                    <span><?= $stats->getAVGRating()?></span>
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
        <div class="add-review">
            <textarea name="message" rows="5" placeholder="message"></textarea>
            <div class="action">
                <select id="rate" name="rate" data-placeholder="rate">
                    <option disabled selected>rate</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button class="add">add</button>
            </div>
        </div>
    </main>
</div>
</body>