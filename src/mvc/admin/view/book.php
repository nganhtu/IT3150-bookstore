<form method="post">
    <label for="nuoc ngoai">Nuoc ngoai</label><input type="radio" id="nuoc ngoai" name="country" value="nuoc ngoai">
    <label for="trong nuoc">Trong nuoc</label><input type="radio" id="trong nuoc" name="country" value="trong nuoc">
    <br>
    <label for="sgk">Sach giao khoa</label><input type="radio" id="sgk" name="genre" value="sgk">
    <label for="ky ao">Ky ao</label><input type="radio" id="ky ao" name="genre" value="ky ao">
    <label for="kinh dien">Kinh dien</label><input type="radio" id="kinh dien" name="genre" value="kinh dien">
    <br>
    <input type="submit" name="filter_submit" value="Filter">
    <?php
    if (isset($_POST['filter_submit'])) {
        if (isset($_POST['country']) && isset($_POST['genre'])) {
            $keyword = $_POST['country'] . ', ' . $_POST['genre'];
            $index = getSearchBooksPage(10, $keyword);
        } elseif (isset($_POST['country'])) {
            $index = getSearchBooksPage(10, $_POST['country']);
        } elseif (isset($_POST['genre'])) {
            $index = getSearchBooksPage(10, $_POST['genre']);
        } else {
            $index = getPage('book', 10);
            $book = paging($index);
        }
    } else {
        $index = getPage('book', 10);
        $book = paging($index);
    }
    ?>
</form>
<h1>Bookshop</h1>
<form method="post">
    <div id="search">
        <div class="row">
            <div class="col-sm-2">
                <label>
                    <input type="text" name="keyword" placeholder="enter keyword">
                </label>
            </div>
            <div class="col-sm-2">
                <input type="submit" name="search" value="Search">
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['search'])) {
        $_SESSION['keyword'] = $_POST['keyword'];
        redirect('search');
    }
    if ($index['total_record'] == 0) {
        echo '<h2>No result found.</h2>';
    } else {
        if (isset($_POST['filter_submit'])) {
            if (!isset($_POST['country']) && !isset($_POST['genre'])) {
                $index = getPage('book', 10);
                $book = paging($index);
            } else {
                $book = searchPaging($index);
            }
        } else {
            $index = getPage('book', 10);
            $book = paging($index);
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
            foreach ($book as $item) {
                echo '<tr>';
                echo '<td>' . $item['bookID']    . '</td>';
                echo '<td>' . $item['bookname']  . '</td>';
                echo '<td>' . $item['author']    . '</td>';
                echo '<td>' . $item['price']     . '</td>';
                echo '<td>' . $item['tag']       . '</td>';
                if ($item['available'] > 0) {
                    echo '<td>available</td>';
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
    }
    ?>
</form>
