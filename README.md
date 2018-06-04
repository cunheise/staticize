Staticize
==========

## install
composer require staticize/staticize

## sample

### bootstrap.php file
    require dirname(__DIR__) . '/vendor/autoload.php';
    
    use Pimple\Container;
    use Staticize\Page;
    use Symfony\Component\Cache\Simple\FilesystemCache;
    
    $container = new Container();
    $container['namespace'] = 'namespace';
    $container['lifetime'] = 1;
    $container['directory'] = dirname(__DIR__) . '/runtime';
    $container['cache'] = function ($c) {
        return new FilesystemCache($c['namespace'], $c['lifetime'], $c['directory']);
    };
    $container['page'] = function ($c) {
        return new Page($c['pagename'], $c['cache']);
    };

### start_end.php sample file
    require __DIR__ . '/bootstrap.php';
    $container['pagename'] = 'start_end.html';
    $container['page']->enclose(function () {
        echo 'enclose page test';
    });
    echo $container['page'];
    
### enclose.php sample file
    require __DIR__ . '/bootstrap.php';
    $container['pagename'] = 'enclose.html';
    $container['page']->enclose(function () {
        echo 'enclose page test';
    });
    echo $container['page'];