<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/loginStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet"> 
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form class="login" action="login" method= "POST">
                <div class="messages">
                    <?php 
                    if(isset($messages)){
                        foreach($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="password">
                <button id="login-button" type ="submit">login</button>
            </form>
                <div class="register">
                    <button id="register-button">not registered yet?</button>  
                </div>
        </div>
    </div>
</body>