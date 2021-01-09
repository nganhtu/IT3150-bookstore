<?php if (!defined('PATH_SYSTEM')) die ('Bad requested!'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title><?php echo $title ?></title>
    <style type="text/css">
        html,
        body {
            height: 100%
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="header">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?php echo createUrl('book') ?>" class="btn btn-light" role="button">Books</a>
                </div>
                <?php if(isset($_SESSION['username'])) { ?>
                    <div class="col-sm-6">
                        <a href="<?php echo createUrl('account') ?>" class="btn btn-light" role="button">Your account: <?php echo $_SESSION['username'] ?></a>
                    </div>
                <?php } else { ?>
                    <div class="col-sm-6">
                        <a href="<?php echo createUrl('login') ?>" class="btn btn-light" role="button">Log in or Sign up</a>
                    </div>
                <?php } ?>
            </div>
            <hr>
        </div>
        <div id="content">
