<!DOCTYPE html>
<html>
    <head>

    <!-- Inportnet info -->
    <title>Sign In</title>
    <meta charset="UTF-8">

    <!-- Include nessary script files. -->
        <script type="text/javascript" src="assets\javascript\failedLogin.js"></script>
        <link rel="stylesheet" type="text/css" href="assets\styles\login.css">
</head>

<!-- Main Html Body -->
    <body>
    
    <div id="LoginDiv">
    <h2 id="title">Sign In</h2>
        <form action="/Mange.php" method="post">
            <input type="text" id="username" name="username" placeholder="Username"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br><br>
            <input id="submit" type="submit" value="Sign In">
        </form> 
    <p id="msg"></p>
    </div>
    
    </body>
</html>