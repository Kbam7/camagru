<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Camagru</title>
<?php include './include/header.php'; ?>
</head>
<body class="fluid">
    <header>
        <h1>Camagru - <small>Take a photo, have some fun!</small></h1>
    </header>

    <div id="error-messages"></div>

    <section class="col-5 offset-left-1 login-form col">
        <form id="loginForm" method="post" enctype="application/x-www-form-urlencoded">
            <div class="form-input">
                <label for="login">Username:</label>
                <input type="text" name="login" id="user-login" placeholder="Username" title="Username can only contain alphanumeric characters and the following special characters: dot (.), underscore(_) and dash (-). The special characters cannot appear more than once consecutively or combined." pattern="(?!.*[\.\-\_]{2,})^[a-zA-Z0-9\.\-\_]{3,24}$" required="true" />
            </div>
            <div class="form-input">
                <label for="passwd">Password:</label>
                <input type="password" name="passwd" id="user-passwd" placeholder="Password" title="Password MUST contain atleast 6 characters with atleast one upper or lower case letter with another upper or lower case letter or a digit." pattern="^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})" required="true" />
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
            <a class="options-button" href="create.php" title="Create an Account">Create Account</a>
        </div>
        <hr />
    </section>


<?php include './include/footer.php'; ?>
