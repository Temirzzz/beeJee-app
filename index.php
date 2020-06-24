<?php
require_once('template/header.php');
require_once('core/config.php');
require_once('core/functions.php');
$conn = connect();
select_main($conn);
$data = select_main($conn);
$countPage = pagination_count($conn);

if (isset($_COOKIE['success']) AND $_COOKIE['success'] != '') {
    if ($_COOKIE['success'] == 1) {
        setcookie('success', 1, time()-5);
        echo "<p class='success'>Задача успешно добавлена</p>";
    }
}
?>

<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-10 col-sm-12">
            <h1 class="mt-5">Добро пожаловать на BeeJee</h1>
            <h3 class="mt-3 mb-5">Список дел</h3>
        </div>
        <div class="col-lg-8 col-md-10 col-sm-12">

            <?php

                $out = '<table class="table text-center main-table">';

                $out .= "<thead>
                <tr>
                <th onclick='sortTable(0)'>Имя</th>
                <th onclick='sortTable(1)'>Эл.почта</th>
                <th onclick='sortTable(2)'>Задание</th>
                <th onclick='sortTable(1)'>Статус</th>
                </tr>
                </thead>";

                for ($i = 0; $i < count($data); $i++) {
                    $out .= "<tbody><tr>";
                    $out .= "<td>{$data[$i]['name']}</td>";
                    $out .= "<td>{$data[$i]['email']}</td>";
                    $out .= "<td>{$data[$i]['content']}</td>"; 
                    if ($data[$i]['complete']) {
                        $out .= "<td class='done'></td>";
                    }
                    else {
                        $out .= "<td class='not-done'></td>";
                    }
                    $out .= "</tr></tbody>";
                }

                $out .= '</table>';

                echo "$out";
            ?>
        </div>        
    </div>
</div>

<div class="container pagination-container mt-4 mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-1 col-md-1 col-sm-1">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm">
                    <?php
                        for ($i = 0; $i < $countPage; $i++) {
                            $j = $i + 1;
                            echo "<li class='page-item'><a class='page-link' href='./index.php?page={$i}'>{$j}</a></li>";                     
                        }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php
require_once('template/footer.php');
?>