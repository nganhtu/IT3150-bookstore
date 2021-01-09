<?php
if (!defined('PATH_SYSTEM')) die ('Bad requested!');

function getPage($table, $limit, $username = null): array
{
    $index = array();
    $index['table'] = $table;
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        if (isset($username)) {
            $result = $conn->query("SELECT COUNT(bookID) AS total FROM $table WHERE username='$username'");
        } else {
            $result = $conn->query("SELECT COUNT(bookID) AS total FROM $table");
        }
        $row = mysqli_fetch_assoc($result);

        $index['total_record'] = $row['total'];
        $index['limit'] = $limit;
        $index['total_page'] = ceil($index['total_record'] / $index['limit']);
        $index['current_page'] = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($index['current_page'] > $index['total_page']) {
            $index['current_page'] = $index['total_page'];
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $index;
}

function paging($index, $username = null): array
// TODO lỗi không kiểm tra username
{
    $book = array();
    $start = ($index['current_page'] - 1) * $index['limit'];
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        if (isset($username)) {
            $result = $conn->query('SELECT * FROM ' . $index['table'] . ' WHERE username=\'' . $username . '\' LIMIT ' . $start . ', ' . $index['limit']);
        } else {
            $result = $conn->query('SELECT * FROM ' . $index['table'] . ' LIMIT ' . $start . ', ' . $index['limit']);
        }

        while ($row = $result->fetch_assoc()) {
            array_push($book, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $book;
}

function getSearchBooksPage($limit, $keyword): array
{
    $index = array();
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT COUNT(bookID) AS total FROM book WHERE bookname LIKE '%$keyword%' OR author LIKE '%$keyword%' OR tag LIKE '%$keyword%'");
        $row = mysqli_fetch_assoc($result);

        $index['total_record'] = $row['total'];
        $index['limit'] = $limit;
        $index['keyword'] = $keyword;
        $index['total_page'] = ceil($index['total_record'] / $index['limit']);
        $index['current_page'] = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($index['current_page'] > $index['total_page']) {
            $index['current_page'] = $index['total_page'];
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $index;
}

function searchPaging($index): array
{
    $book = array();
    $keyword = $index['keyword'];
    $limit = $index['limit'];
    $start = ($index['current_page'] - 1) * $index['limit'];
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT * FROM book WHERE bookname LIKE '%$keyword%' OR author LIKE '%$keyword%' OR tag LIKE '%$keyword%' LIMIT $start, $limit") or die($conn->error);

        while ($row = $result->fetch_assoc()) {
            array_push($book, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $book;
}

function getHistoryPage($limit): array
{
    $index = array();
    $username = $_SESSION['username'];
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT COUNT(bookID) AS total FROM history WHERE username LIKE '%$username%'");
        $row = mysqli_fetch_assoc($result);

        $index['total_record'] = $row['total'];
        $index['limit'] = $limit;
        $index['total_page'] = ceil($index['total_record'] / $index['limit']);
        $index['current_page'] = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($index['current_page'] > $index['total_page']) {
            $index['current_page'] = $index['total_page'];
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $index;
}

function historyPaging($index): array
{
    $book = array();
    $username = $_SESSION['username'];
    $limit = $index['limit'];
    $start = ($index['current_page'] - 1) * $index['limit'];
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query("SELECT * FROM history WHERE username='$username' ORDER BY date DESC LIMIT $start, $limit") or die($conn->error);

        while ($row = $result->fetch_assoc()) {
            array_push($book, $row);
        }
        $conn->close();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $book;
}
