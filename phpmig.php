<?php

# phpmig.php

use \Phpmig\Adapter,
    \Pimple;

$container = new Pimple();

$container['db'] = $container->share(function() {
    $dbh = new PDO('mysql:dbname=foglifter_live;host=127.0.0.1','root','');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
});

$container['phpmig.adapter'] = $container->share(function() use ($container) {
    return new Adapter\PDO\Sql($container['db'], 'migrations');
});

$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

return $container;