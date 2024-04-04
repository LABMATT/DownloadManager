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
        <form action="/action_page.php">
            <input type="text" id="username" name="username" placeholder="Username"><br>
            <input type="text" id="password" name="password" placeholder="Password"><br><br>
            <input id="submit" type="submit" value="Sign In">
        </form> 
    <p id="msg">Error Loging In</p>
    </div>
    
    </body>
</html>