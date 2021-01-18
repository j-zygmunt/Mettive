<div class="review">
    <div class="msginfo">
        <div class="sender-info">
            <p><?= $review->getReviewedAt() ?></p>
            <h2><?= $review->getReviewerName() ?> <?= $review->getReviewerSurname()?></h2>
        </div>
        <img src="/public/uploads/<?= $review->getReviewerPhoto() ?>">
    </div>
    <div class="message">
        <p><?= $review->getMessage() ?></p>
    </div>
    <div class="action">
        <p>rate: <span><?= $review->getRating() ?></span></p>
        <button class="report-button">
            <i class="fas fa-flag"></i>
        </button>
    </div>
</div>