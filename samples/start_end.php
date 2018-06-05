<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/6/4
 * Time: 9:28
 */
require __DIR__ . '/bootstrap.php';
$container['pagename'] = 'start_end.html';
if (!$container['page']->isValid()) {
    $container['page']->start();
    echo 'start end page';
    $container['page']->end();
}
echo $container['page'];