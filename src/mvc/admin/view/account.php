<?php
if (!isset($_SESSION['username'])) {
    redirect('login');
}
?>
<a href="<?php echo createUrl('cart') ?>" class="btn btn-light" role="button">Your cart</a>&nbsp&nbsp
<a href="<?php echo createUrl('history') ?>" class="btn btn-light" role="button">Purchase history</a><br><br>
<form method="post">
    <input type="submit" class="btn btn-dark" name="logout" value="Log out">
    <?php
    if (isset($_POST['logout'])) {
        session_unset();
        redirect('login');
    }
    ?>
</form><br>
<form method="post">
    <label>Change password:&nbsp
        <input type="password" name="change_password" placeholder="enter new password">&nbsp
        <input type="submit" name="submit_change_password" value="change">
    </label>
    <?php
    if (isset($_POST['submit_change_password'])) {
        if (empty($_POST['change_password'])) {
            echo 'Password must be not null';
        } else {
            changePassword($_SESSION['username'], $_POST['change_password']);
            echo 'Your password is changed';
            header("Refresh:0");
        }
    }
    ?>
</form>
<br>
<form method="post">
    <label>Change address:&nbsp&nbsp&nbsp&nbsp
        <input type="text" name="change_address" placeholder="enter new address">&nbsp
        <input type="submit" name="submit_change_address" value="change">
    </label>
    <?php
    if (isset($_POST['submit_change_address'])) {
        if (empty($_POST['change_address'])) {
            echo 'Address must be not null';
        } else {
            changeAddress($_SESSION['username'], $_POST['change_address']);
            echo 'Your address is changed';
            header("Refresh:0");
        }
    }
    ?>
</form>
<br>
<form method="post">
    <input type="submit" name="delete_history" value="Delete your purchase history" class="btn btn-danger" role="button">
    <?php
    if (isset($_POST['delete_history'])) {
        deleteHistory($_SESSION['username']);
        echo 'Purchase history deleted!';
        header("Refresh:0");
    }
    ?>
</form>
