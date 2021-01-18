<img src="public/uploads/<?= $userProfile->getPhoto()?>">
<div class="info">
    <div class="stats">
        <h2><?= $stats->getReviewsAmount()?></h2>
        <h2><?= $stats->getFollowersAmount()?></h2>
        <h2><?= $stats->getFollowingAmount()?></h2>
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
        <?= $userProfile->getMainLanguage() ?>
        <span><?= $stats->getAVGRating() ?></span>
        <br>
    </div>
</div>