<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/scrollbarStyle.css">
    <link rel="stylesheet" type="text/css" href="/public/css/navigationStyle.css">
    <link rel="stylesheet" type="text/css" href="/public/css/myProfileStyle.css">
    <link rel="stylesheet" type="text/css" href="/public/css/profilePanel.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6b1d99aa4c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/./public/js/editProfile.js" defer></script>
    <script type="text/javascript" src="/./public/js/mobile.js" defer></script>
    <title>EDIT PROFILE</title>
</head>
<body>
<div class="base-container">
    <nav>
        <?php include("header.php")?>
    </nav>
    <main>
        <section class="profile-panel">
            <?php include("profile-panel.php")?>
            <button class="save-profile-button" type="submit">save changes</button>
        </section>
        <section class="edit-panel">
            <h1>edit profile</h1>
            <form id="edit" action="editProfile" enctype="multipart/form-data" method="POST">
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
                <label for="myfile">Select a file:</label>
                <input type="file" accept="image/png, image/jpeg" name='file'><br/>
                <input type="text" name='city' placeholder="city"><br/>
                <input type="text" name='country' placeholder="country"><br/>
            </form>
        </section>
        <?php include("about-panel.php")?>
    </main>
</div>
</body>