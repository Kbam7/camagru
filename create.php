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
                <label class="input_label" for="firstname">Firstname:</label>
                <input type="text" name="firstname" id="fname" value="" placeholder="Firstname" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <label class="input_label" for="lastname">Lastname:</label>
                <input type="text" name="lastname" id="lname" value="" placeholder="Lastname" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <label class="input_label" for="username">Username:</label>
                <input type="text" name="username" id="uname" value="" placeholder="Username" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <label class="input_label" for="emailaddr">Email Address:</label>
                <input type="email" name="emailaddr" id="email" value="" placeholder="Email Address" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <label class="input_label" for="password">Password:</label>
                <input type="password" name="password" id="passwd" value="" placeholder="Password" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <label class="input_label" for="password">Confirm Password:</label>
                <input type="password" name="password2" id="passwd2" value="" placeholder="Confirm Password" autocomplete="true" required="true" />
            </div>
            <div class="form-input">
                <input type="submit" name="submit" value="OK" />
            </div>
        </form>
    </section>

<?php include './include/footer.php'; ?>
