<!DOCTYPE html>
<html>

<head>
    <title>Camagru</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="css/modulr.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/camera.js"></script>

</head>

<body class="fluid">
    <header>
        <h1>Camagru - <small>Take a photo, have some fun!</small></h1>
    </header>
    <section class="col-5 offset-left-1 login-form ">
        <form method="post" action="login.php">
            <div class="form-input">
                <label for="login">Username:</label>
                <input type="text" name="login" id="user-login" placeholder="Username" />
            </div>
            <div class="form-input">
                <label for="passwd">Password:</label>
                <input type="password" name="passwd" id="user-passwd" placeholder="Password" />
            </div>
            <div class="form-input">
                <label name="remember" for="remember-user">Remember me</label>
                <input type="checkbox" name="remember" id="remember-me" />
            </div>
            <div class="form-input">
                <input type="submit" name="submit" value="OK" />
            </div>
        </form>
    </section>
    <section class="col-5 offset-left-1 options">
        <div class="create-account">
            <h2>Are you new around here?</h2>
            <p>
                Create a free account now and get in on all the latest news and gossip!
            </p>
            <a class="options-button" href="create.html" title="Create an Account">Create Account</a>
        </div>
        <hr />
        <div class="modify-account">
            <h2>Account Settings</h2>
            <p>
                Change the password for your account.
            </p>
            <a class="options-button" href="modify.html" title="Change Password">Change Password</a>
        </div>
    </section>

<?php include 'footer.php'; ?>