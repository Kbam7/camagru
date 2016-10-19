<!doctype html>
<html>
<head>
    <title>Create Account | Camagru</title>
<?php include './include/header.php'; ?>
</head>
<body>
    <header>
        <h1><a href="index.php">Create Account</a></h1>
    </header>

    <div id="error-messages"></div>

    <section class="col-8 offset-left-2">
        <form id="createUserForm" method="post" enctype="application/x-www-form-urlencoded">
            <div class="form-input">
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" id="fname" value="" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <label for="lastname">Lastname:</label>
                <input type="text" name="lastname" id="lname" value="" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <label for="username">Username:</label>
                <input type="text" name="username" id="uname" value="" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <label for="emailaddr">Email Address:</label>
                <input type="email" name="emailaddr" id="email" value="" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <label for="password">Password:</label>
                <input type="password" name="password" id="passwd" value="" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <input type="submit" name="submit" value="OK" />
            </div>
        </form>
    </section>

<?php include './include/footer.php'; ?>
