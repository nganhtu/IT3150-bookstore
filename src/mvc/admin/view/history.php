<?php
if (!isset($_SESSION['username'])) {
    redirect('login');
}
$history = getBooksInHistory($_SESSION['username']);
if (empty($history)) {
    echo '<h1>Your purchase history is empty.</h1>';
} else {
    $index = getHistoryPage(10);
    $history = historyPaging($index);
?>
    <h1>Purchase history</h1>
    <table>
        <tr>
            <th>Date    </th>
            <th>Bookname</th>
            <th>Amount  </th>
        </tr>

        <?php
        foreach ($history as $item) {
            echo '<tr>';
            echo '<td>' .             $item['date']    . '</td>';
            echo '<td>' . getBookName($item['bookID']) . '</td>';
            echo '<td>' .             $item['amount']  . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    <?php
    if ($index['current_page'] > 1 && $index['total_page'] > 1) {
        echo '<a href="' . createUrl('history', 'index', $index['current_page'] - 1) . '" class="btn btn-light" role="button">prev</a>&nbsp';
    }
    for ($i = 1; $i <= $index['total_page']; $i++) {
        if ($i == $index['current_page']) {
            echo '<span class="btn btn-info" role="button">' . $i . '</span>&nbsp';
        } else {
            echo '<a href="' . createUrl('history', 'index', $i) . '" class="btn btn-light" role="button">' . $i . '</a>&nbsp';
        }
    }
    if ($index['current_page'] < $index['total_page'] && $index['total_page'] > 1) {
        echo '<a href="' . createUrl('history', 'index', $index['current_page'] + 1) . '" class="btn btn-light" role="button">next</a>';
    }
}
?>
