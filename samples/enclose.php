<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/6/4
 * Time: 9:28
 */
require __DIR__ . '/bootstrap.php';
$container['pagename'] = 'enclose.html';
if (!$container['page']->isValid()) {
    $container['page']->enclose(function () {
        echo 'enclose page test';
    });
}
echo $container['page'];