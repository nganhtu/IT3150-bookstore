<?php
if ($_SESSION['keyword'] == '') {
    redirect('book');
}
$index = getSearchBooksPage(10, $_SESSION['keyword']);
$searchedBooks = searchPaging($index);
?>
<form method="post">
    <div id="search">
        <div class="row">
            <div class="col-sm-3">
                <label>
                    <input type="text" name="keyword" placeholder="enter keyword">
                </label>
            </div>
            <div class="col-sm-3">
                <input type="submit" name="search" value="Search">
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['search'])) {
        $_SESSION['keyword'] = $_POST['keyword'];
        redirect('search');
    }
    ?>
</form>
<br>
<h3>Search results for "<?php echo $_SESSION['keyword'] ?>":</h3>
<h3><?php echo $index['total_record'] ?> results found.</h3>
<form method="post">
    <?php
    if (isset($_POST['search'])) {
        $_SESSION['keyword'] = $_POST['keyword'];
        redirect('search');
    }
    ?>
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
        foreach ($searchedBooks as $item) {
            echo '<tr>';
            echo '<td>' . $item['bookID']    . '</td>';
            echo '<td>' . $item['bookname']  . '</td>';
            echo '<td>' . $item['author']    . '</td>';
            echo '<td>' . $item['price']     . '</td>';
            echo '<td>' . $item['tag']       . '</td>';
            if ($item['available'] > 0) {
                echo '<td>available: ' . $item['available'] . '</td>';
            } else {
                echo '<td>unavailable</td>';
            }
            echo '<td><a href="' . createUrl('item', 'index', null, $item['bookID']) . '" class="btn btn-light" role="button">view details</a></td>';
            echo '</tr>';
        }
        ?>
    </table>

    <?php
    if ($index['current_page'] > 1 && $index['total_page'] > 1) {
        echo '<a href="' . createUrl('book', 'index', $index['current_page'] - 1) . '" class="btn btn-light" role="button">prev</a>&nbsp';
    }
    for ($i = 1; $i <= $index['total_page']; $i++) {
        if ($i == $index['current_page']) {
            echo '<span class="btn btn-info" role="button">' . $i . '</span>&nbsp';
        } else {
            echo '<a href="' . createUrl('book', 'index', $i) . '" class="btn btn-light" role="button">' . $i . '</a>&nbsp';
        }
    }
    if ($index['current_page'] < $index['total_page'] && $index['total_page'] > 1) {
        echo '<a href="' . createUrl('book', 'index', $index['current_page'] + 1) . '" class="btn btn-light" role="button">next</a>';
    }
    ?>
</form>
