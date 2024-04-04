<!DOCTYPE html>
<html>
    <head>

    <!-- Inportnet info -->
    <title>Sign In</title>
    <meta charset="UTF-8">

    <!-- Include nessary script files. -->
    <script type="text/javascript" src="assets\javascript\SignInmsg.js"></script>

    <!-- Include nessary CSS files. -->
    <link rel="stylesheet" type="text/css" href="assets\styles\login.css">

</head>

<!-- Main Html Body -->
    <body>
    
    <div id="LoginDiv">
    <h2 class="textContent">Sign In To Server</h2>
        <form class="textContent">
            <input class="formInputs" type="text" id="fname" name="username" placeholder="Username"><br>
            <input class="formInputs" type="password" id="lname" name="password" placeholder="Password"><br>
            <input id="submit" type="submit" value="Sign In">
        </form>
        
        <p id="msg">To many attempts signing in</p>
    </div>
    
    </body>
</html>