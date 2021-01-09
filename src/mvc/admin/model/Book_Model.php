<?php
if (!defined('PATH_SYSTEM')) die ('Bad requested!');

function getBooks(): array
{
    $book = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT * FROM book");
        while ($row = $result->fetch_assoc()) {
            array_push($book, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $book;
}

function updateAvailableBooks($bookID, $amount) {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $available = array();
        $result = $conn->query("SELECT available FROM book WHERE bookID='$bookID'");
        while ($row = $result->fetch_assoc()) {
            array_push($available, $row);
        }
        $tmp_available = 0;
        foreach ($available as $item) {
            $tmp_available = $item['available'] - $amount;
        }
        $conn->query("UPDATE book SET available='$tmp_available' WHERE bookID='$bookID' ");
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getBookName($bookID): string
{
    $books_in_cart = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT bookname FROM book WHERE bookID='$bookID'");
        while ($row = $result->fetch_assoc()) {
            array_push($books_in_cart, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $bookname = '';
    foreach ($books_in_cart as $item) {
        $bookname = $item['bookname'];
    }

    return $bookname;
}

function getAuthor($bookID): string
{
    $books_in_cart = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT author FROM book WHERE bookID='$bookID'");
        while ($row = $result->fetch_assoc()) {
            array_push($books_in_cart, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $author = '';
    foreach ($books_in_cart as $item) {
        $author = $item['author'];
    }

    return $author;
}

function getPrice($bookID): string
{
    $books_in_cart = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT price FROM book WHERE bookID='$bookID'");
        while ($row = $result->fetch_assoc()) {
            array_push($books_in_cart, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $price = '';
    foreach ($books_in_cart as $item) {
        $price = $item['price'];
    }

    return $price;
}

function getAvailable($bookID): int
{
    $books_in_cart = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT available FROM book WHERE bookID='$bookID'");
        while ($row = $result->fetch_assoc()) {
            array_push($books_in_cart, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $available = '';
    foreach ($books_in_cart as $item) {
        $available = $item['available'];
    }

    return $available;
}

function getTag($bookID): string
{
    $books_in_cart = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT tag FROM book WHERE bookID='$bookID'");
        while ($row = $result->fetch_assoc()) {
            array_push($books_in_cart, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $tag = '';
    foreach ($books_in_cart as $item) {
        $tag = $item['tag'];
    }

    return $tag;
}
