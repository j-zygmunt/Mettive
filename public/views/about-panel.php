<section class="about-panel">
    <div class="about-me">
        <h2>about me</h2>
        <p><?= $userProfile->getAboutMe(); ?></p>
        <h2><?= $userProfile->getCountry(); ?>, <?= $userProfile->getCity(); ?></h2>
    </div>
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
</section>