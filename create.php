<!doctype html>
<html>
<head>
    <title>Create Account | Camagru</title>
<?php include './include/header.php'; ?>
</head>
<body>
    <header class="global-style">
        <h1><a href="index.php">Create Account</a></h1>
    </header>
    <section class="global-style">
        <form method="post" action="php/create_acc.php">
            <div class="form-input">
                <label for="login">Username:</label>
                <input type="text" name="login" id="user-login" value="" />
            </div>
            <div class="form-input">
                <label for="user-passwd">Password:</label>
                <input type="password" name="passwd" id="user-passwd" value="" />
            </div>
            <div class="form-input">
                <input type="submit" name="submit" value="OK" />
            </div>
        </form>
    </section>

<?php include './include/footer.php'; ?>