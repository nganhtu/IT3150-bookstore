<?php
if (!defined('PATH_SYSTEM')) die ('Bad requested!');

function legit($username, $password): bool
{
    try {
        $user = array();
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT username, password FROM user");
        while ($row = $result->fetch_assoc()) {
            array_push($user, $row);
        }
        foreach ($user as $item) {
            if ($item['username'] == $username) {
                if (($item['password']) ==  md5($password)) {
                    return true;
                }
            }
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return false;
}

function alreadyExist($username): bool
{
    try {
        $user = array();
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT username FROM user");
        while ($row = $result->fetch_assoc()) {
            array_push($user, $row);
        }
        foreach ($user as $item) {
            if ($item['username'] == $username) {
                return true;
            }
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return false;
}

function createUser($username, $fullname, $password, $address) {
    $hashed_password = md5($password);
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $conn->query("INSERT INTO user (username, fullname, password, address) VALUES ('$username', '$fullname', '$hashed_password', '$address')");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function changePassword($username, $newPassword) {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $newPassword = md5($newPassword);
        $conn->query("UPDATE user SET password='$newPassword' WHERE username='$username'");
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function changeAddress($username, $newAddress) {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $conn->query("UPDATE user SET address='$newAddress' WHERE username='$username'");
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getAddress($username): string
{
    $user = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT address FROM book WHERE username='$username'");
        while ($row = $result->fetch_assoc()) {
            array_push($user, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $address = '';
    foreach ($user as $item) {
        $address = $item['address'];
    }

    return $address;
}

function deleteHistory($username) {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $conn->query("DELETE FROM history WHERE username='$username'");
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function updatePurchaseHistory($username) {
    $books_in_cart = getBooksInCart($username);
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        foreach ($books_in_cart as $item) {
            $bookID = $item['bookID'];
            $date = date("Y-m-d");
            $amount = $item['amount'];
            $conn->query("INSERT INTO history VALUES ('$username', '$bookID', '$date', '$amount')");
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getBooksInHistory($username): array
{
    $books_in_history = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT * FROM history WHERE username='$username'");
        while ($row = $result->fetch_assoc()) {
            array_push($books_in_history, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $books_in_history;
}