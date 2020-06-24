<?php
require_once('core/config.php');
require_once('core/functions.php');
require_once('template/header_admin.php');
$conn = connect();
$data = select($conn);
require_once('./check.php');
close ($conn);
?>

<h1 class="text-center mt-3 mb-5">Панель администратора</h1>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-10 col-sm-10">
            <?php
                $out = '<table class="table table-striped text-center">';

                $out .= "<thead>
                <tr>
                <th>id</th>
                <th>Имя</th>
                <th>Электронная почта</th>
                <th>Задача</th>
                <th>Статус</th>
                <th>Обновить</th>
                <th>Пометить выполненным</th>
                </tr></thead>";

                for ($i = 0; $i < count($data); $i++) {
                    $out .= "<tbody><tr>";
                    $out .= "<td class='id'>{$data[$i]['id']}</td>";
                    $out .= "<td>{$data[$i]['name']}</td>";
                    $out .= "<td>{$data[$i]['email']}</td>";
                    $out .= "<td>{$data[$i]['content']}</td>";

                    if ($data[$i]['complete']) {
                        $out .= "<td class='done'></td>";
                    }
                    else {
                        $out .= "<td class='not-done'></td>";
                    }

                    $out .= "<td><a href='./admin_update.php?id={$data[$i]['id']}' class='btn btn-info'>Обновить</a></td>";
                    $out .= "<td><a href='./mark.php?id={$data[$i]['id']}' class='btn btn-info btn-done'>&#x2714;</a></td>";
                    $out .= "</tr></tbody>"; 
                }
                $out .= '</table>';

                echo "$out";
            ?>
        </div>
    </div>
</div>

