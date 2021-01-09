<?php
if (!defined('PATH_SYSTEM')) die ('Bad requested!');

function addToCart($username, $bookID, $amount) {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $checkLegit = array();
        $result = $conn->query("SELECT * FROM cart WHERE username='$username' AND bookID='$bookID'");
        while ($row = $result->fetch_assoc()) {
            array_push($checkLegit, $row);
        }
        $tmp_amount = $amount;
        foreach ($checkLegit as $item) {
            $tmp_amount += $item['amount'];
        }
        $conn->query("INSERT INTO cart (username, bookID, amount) VALUES ('$username', '$bookID', '$amount')");
        $conn->query("UPDATE cart SET amount='$tmp_amount' WHERE username='$username' AND bookID='$bookID' ");
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getBooksInCart($username): array
{
    $books_in_cart = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT * FROM cart WHERE username='$username'");
        while ($row = $result->fetch_assoc()) {
            array_push($books_in_cart, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $books_in_cart;
}

function getSum($username): int
{
    $result = 0;
    $book = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $sql = $conn->query("SELECT bookID, amount FROM cart WHERE username='$username'");
        while ($row = $sql->fetch_assoc()) {
            array_push($book, $row);
        }

        foreach ($book as $item) {
            $result += $item['amount'] * getPrice($item['bookID']);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $result;
}

function updateAmount($username, $bookID, $amount) {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $conn->query("UPDATE cart SET amount='$amount' WHERE username='$username' AND bookID='$bookID' ");
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function deleteCart($username) {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $conn->query("DELETE FROM cart WHERE username='$username'");
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
