<?php
if (!isset($_SESSION['username'])) {
    redirect('login');
}
$books_in_cart = getBooksInCart($_SESSION['username']);
if (empty($books_in_cart)) {
    echo '<h1>Your cart is empty.</h1>';
} else {
    $index = getPage('cart', 10, $_SESSION['username']);
    $books_in_cart = paging($index, $_SESSION['username']);
?>
    <h1>Your cart</h1>
    <form method="post">
        <table>
            <tr>
                <th>Book ID      </th>
                <th>Book name    </th>
                <th>Author       </th>
                <th>Price        </th>
                <th>Amount       </th>
                <th>Change amount</th>
                <th>Submit       </th>
            </tr>

            <?php
            foreach ($books_in_cart as $item) {
                echo '<tr>';
                echo '<td>' .             $item['bookID']  . '</td>';
                echo '<td>' . getBookName($item['bookID']) . '</td>';
                echo '<td>' .   getAuthor($item['bookID']) . '</td>';
                echo '<td>' .    getPrice($item['bookID']) . '</td>';
                echo '<td>' .             $item['amount']  . '</td>';
                echo '<td><input type="number" name="amount_change_' . $item['bookID'] . '_value" value="' . $item['amount'] . '"></td>';
                echo '<td><input type="submit" name="change_amount_' . $item['bookID'] . '" value="change amount"></td>';
                echo '</tr>';
            }
            echo '<tr><td></td><td></td><td></td><td>Sum: ' . getSum($_SESSION['username']) . '</td><td></td><td></td></tr>';
            echo '<tr><td></td><td></td><td></td><td><input type="submit" name="pay" value="pay"></td><td></td><td></td></tr>';

            foreach ($books_in_cart as $item) {
                $submit_change_amount = 'change_amount_' . $item['bookID'];
                $changed_amount       = 'amount_change_' . $item['bookID'] . '_value';
                if (isset($_POST[$submit_change_amount])) {
                    if ($_POST[$changed_amount] >= 0 && $_POST[$changed_amount] <= $item['amount'] + getAvailable($item['bookID'])) {
                        updateAmount($_SESSION['username'], $item['bookID'], $_POST[$changed_amount]);
                        updateAvailableBooks($item['bookID'], $_POST[$changed_amount] - $item['amount']);
                        header("Refresh:0");
                    } else {
                        echo 'Changed amount is ' . $changed_amount . ', unavailable.<br>';
                    }
                }
            }

            if (isset($_POST['pay'])) {
                updatePurchaseHistory($_SESSION['username']);
                deleteCart($_SESSION['username']);
                header("Refresh:0");
            }
            ?>
        </table>

        <?php
        if ($index['current_page'] > 1 && $index['total_page'] > 1) {
            echo '<a href="' . createUrl('cart', 'index', $index['current_page'] - 1) . '" class="btn btn-light" role="button">prev</a>&nbsp';
        }
        for ($i = 1; $i <= $index['total_page']; $i++) {
            if ($i == $index['current_page']) {
                echo '<span class="btn btn-info" role="button">' . $i . '</span>&nbsp';
            } else {
                echo '<a href="' . createUrl('cart', 'index', $i) . '" class="btn btn-light" role="button">' . $i . '</a>&nbsp';
            }
        }
        if ($index['current_page'] < $index['total_page'] && $index['total_page'] > 1) {
            echo '<a href="' . createUrl('cart', 'index', $index['current_page'] + 1) . '" class="btn btn-light" role="button">next</a>';
        }
        ?>
    </form>
<?php } ?>
