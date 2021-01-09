<?php
if (isset($_SESSION['username'])) {
    redirect('book');
}
?>
<h1>Log in</h1>
<form method="post">
    <label>
        <input type="text" name="username_login" placeholder="Enter your username">
    </label><br><br>
    <label>
        <input type="password" name="password_login" placeholder="Enter your password">
    </label><br><br>
    <input type="submit" name="login" value="Log in"><br><br>
    <?php
    $error_login = false;
    if (isset($_POST['login'])) {
        if (empty($_POST['username_login'])) {
            $error_login = true;
            echo 'Username must be not null<br>';
        }
        if (empty($_POST['password_login'])) {
            $error_login = true;
            echo 'Password must be not null<br>';
        }
        if (!$error_login) {
            if (!legit($_POST['username_login'], $_POST['password_login'])) {
                $error_login = true;
                echo 'Username or password is wrong';
            }
            if (!$error_login) {
                $_SESSION['username'] = $_POST['username_login'];
                redirect('book');
            }
        }
    }
    ?>
</form>
<h2>or</h2>
<h1>Sign up</h1>
<form method="post">
    <label>
        <input type="text" name="username_signup" placeholder="Enter your username">
    </label><br><br>
    <label>
        <input type="password" name="password_signup" placeholder="Enter your password">
    </label><br><br>
    <label>
        <input type="password" name="reenter_password_signup" placeholder="Re-enter your password">
    </label><br><br>
    <label>
        <input type="text" name="fullname_signup" placeholder="Enter your full name">
    </label><br><br>
    <label>
        <input type="text" name="address_signup" placeholder="Enter your address">
    </label><br><br>
    <input type="submit" name="signup" value="Sign up"><br><br>
    <?php
    $error_signup = false;
    if (isset($_POST['signup'])) {
        if (empty($_POST['username_signup'])) {
            $error_signup = true;
            echo 'Username must be not null<br>';
        }
        if (empty($_POST['password_signup']) or empty($_POST['reenter_password_signup'])) {
            $error_signup = true;
            echo 'Password must be not null<br>';
        }
        if (empty($_POST['fullname_signup'])) {
            $error_signup = true;
            echo 'Full name must be not null<br>';
        }
        if (empty($_POST['address_signup'])) {
            $error_signup = true;
            echo 'Address must be not null<br>';
        }
        if ($_POST['password_signup'] != $_POST['reenter_password_signup']) {
            $error_signup = true;
            echo 'Check your password again<br>';
        }
        if (!$error_signup) {
            if (alreadyExist($_POST['username_signup'])) {
                $error_signup = true;
                echo 'Username has already exist<br>';
            }
            if (!$error_signup) {
                createUser($_POST['username_signup'], $_POST['fullname_signup'], $_POST['password_signup'], $_POST['address_signup']);
                $_SESSION['username'] = $_POST['username_signup'];
                redirect('book');
            }
        }
    }
    ?>
</form>
