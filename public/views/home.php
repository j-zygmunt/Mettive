<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/scrollbarStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/navigationStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/homeStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/6b1d99aa4c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>HOME PAGE</title>
</head>
<body>
    <div class="base-container">
        <nav>
            <?php include("header.php")?>
        </nav>
        <main>
            <section class="search-panel">
                <div class="search">
                    <input placeholder="search profile">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="langauge-select">
                    <select id="langauge" name="langauge" data-placeholder="langauge">
                        <option disabled selected>langauge</option>
                        <option value="english">English</option>
                        <option value="spanish">Spanish</option>
                        <option value="polish">Polish</option>
                        <option value="german">German</option>
                    </select>
                </div>
                <div class="country-select">
                    <select id="country" name="country" data-placeholder="country">
                        <option disabled selected>country</option>
                        <option value="poland">Poland</option>
                    </select>
                </div>
                <div class="city-select">
                    <select id="city" name="city" data-placeholder="city">
                        <option disabled selected>city</option>
                        <option value="krakow">Krakow</option>
                    </select>
                </div>
                <div class="date">
                    <label>date:</label>
                    <form>
                        <input placeholder="from" type="text" onclick="(this.type = 'date')" onblur="(this.type='text')" id="from">
                        <input placeholder="to" type="text" onclick="(this.type = 'date')" onblur="(this.type='text')" id="to">
                    </form>
                </div>
            </section>
            <section class="profiles-panel">
                <?php foreach($usersProfiles as $userProfile): ?>
                <div id="profile">
                    <img src="public/uploads/<?= $userProfile->getPhoto() ?>">
                    <div>
                        <h2><?= $userProfile->getName(); ?> <?= $userProfile->getSurname(); ?></h2>
                        <p>Country City Langauge</p>
                        <div class="social">
                            <button class="message-button">
                                <i class="fas fa-user-circle"></i>
                            </button>
                            <button class="follow-button">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </main>
    </div>
</body>

<template id="profile-template">
    <div id="">
        <img src="">
        <div>
            <h2>Name Surname</h2>
            <p>Country City Langauge</p>
            <div class="social">
                <button class="message-button">
                    <i class="fas fa-user-circle"></i>
                </button>
                <button class="follow-button">
                    <i class="fas fa-plus-circle"></i>
                </button>
            </div>
        </div>
    </div>
</template>