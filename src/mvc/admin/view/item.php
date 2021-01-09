<?php
if (!isset($_GET['bookID'])) {
    redirect('book');
}
$book = getBooks();
?>
<form method="post">
    <table>
        <tr>
            <th>Book ID  </th>
            <th>Book name</th>
            <th>Author   </th>
            <th>Price    </th>
            <th>Tag      </th>
            <th>Available</th>
            <th>Amount   </th>
            <th>Submit   </th>
        </tr>
        <?php
        foreach ($book as $item) {
            if ($item['bookID'] == $_GET['bookID']) {
                echo '<tr>';
                echo '<td>' . $item['bookID'] . '</td>';
                echo '<td>' . $item['bookname'] . '</td>';
                echo '<td>' . $item['author'] . '</td>';
                echo '<td>' . $item['price'] . '</td>';
                echo '<td>' . $item['tag'] . '</td>';
                echo '<td>' . $item['available'] . '</td>';
                echo '<td><input type="number" name="amount_' . $item['bookID'] . '" value="0"></td>';
                echo '<td><input type="submit" name="add_to_cart_' . $item['bookID'] . '" value="add to cart"></td>';
                echo '</tr>';
            }
        }

        foreach ($book as $item) {
            $amount    = 'amount_'      . $item['bookID'];
            $addToCart = 'add_to_cart_' . $item['bookID'];
            if (isset($_POST[$addToCart])) {
                if (isset($_SESSION['username'])) {
                    if ($_POST[$amount] > 0 && $_POST[$amount] <= $item['available']) {
                        addToCart($_SESSION['username'], $item['bookID'], $_POST[$amount]);
                        updateAvailableBooks($item['bookID'], $_POST[$amount]);
                        redirect('book');
                    } elseif ($_POST[$amount] != 0) {
                        echo 'Invalid amount: ' . $_POST['amount'] . '<br>';
                    }
                } else {
                    redirect('login');
                }
            }
        }
        ?>
    </table>
</form>
<br>
<h2>More similar books</h2>
<table>
    <tr>
        <th>Book ID  </th>
        <th>Book name</th>
        <th>Author   </th>
        <th>Price    </th>
        <th>Tag      </th>
        <th>Available</th>
        <th>         </th>
    </tr>

    <?php
    foreach ($book as $item) {
        if ($item['bookID'] != $_GET['bookID'] && (($item['author'] == getAuthor($_GET['bookID']) || $item['tag'] == getTag($_GET['bookID'])))) {
            echo '<tr>';
            echo '<td>' . $item['bookID'] . '</td>';
            echo '<td>' . $item['bookname'] . '</td>';
            echo '<td>' . $item['author'] . '</td>';
            echo '<td>' . $item['price'] . '</td>';
            echo '<td>' . $item['tag'] . '</td>';
            if ($item['available'] > 0) {
                echo '<td>' . $item['available'] . '</td>';
            } else {
                echo '<td>unavailable</td>';
            }
            echo '<td><a href="' . createUrl('item', 'index', null, $item['bookID']) . '" class="btn btn-light" role="button">view details</a></td>';
            echo '</tr>';
        }
    }
    ?>
</table>
