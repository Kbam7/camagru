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
    <?php if (isset($_SESSION['errors'])): ?>
    <div id="form-errors">
        <?php foreach($_SESSION['errors'] as $error): ?>
            <p><?php echo $error ?></p>
        <?php 
            endforeach;
            unset($_SESSION['errors']);
        ?>
    </div>
    <?php endif; ?>
    <section class="col-5 offset-left-1 login-form col">
        <form method="post" action="php/login.php">
            <div class="form-input">
                <label for="login">Username:</label>
                <input type="text" name="login" id="user-login" placeholder="Username" required="true" />
            </div>
            <div class="form-input">
                <label for="passwd">Password:</label>
                <input type="password" name="passwd" id="user-passwd" placeholder="Password" required="true" />
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
            <a class="options-button" href="create.php" title="Create an Account">Create Account</a>
        </div>
        <hr />
        <div class="modify-account">
            <h2>Account Settings</h2>
            <p>
                Change the password for your account.
            </p>
            <a class="options-button" href="modify.php" title="Change Password">Change Password</a>
        </div>
    </section>


<?php include './include/footer.php'; ?>