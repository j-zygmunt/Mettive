<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/scrollbarStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/registerStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet"> 
    <title>REGISTER PAGE</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="register-container">
            <form class="register">
                    <input name="name" type="text" placeholder="name">
                    <input name="surname" type="text" placeholder="surname">
                    <input name="email" type="text" placeholder="email@email.com">
                    <input name="password" type="password" placeholder="password">
                    <input name="repeat-password" type="password" placeholder="password">
                    <div class="checkbox">
                        <input type="checkbox" id="accept" name="accept" value="Accept">
                        <label for="accept"> I accept the terms and conditions </label>
                    </div>
                    <button id="register-button">register</button>
            </form>
        </div>
    </div>
</body>