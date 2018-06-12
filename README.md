Staticize
==========
This is library can put php output buffer content into cache like redis, memcache, filesystem, and so on.

## install
    composer require staticize/staticize

Have Question or Feedback?
--------------------------
if you have any question or feedback, contact me Q:26441530 or cunheise [at] 163.com

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
    if (!$container['page']->isValid()) {
        $container['page']->start();
        echo 'start end page';
        $container['page']->end();
    }
    echo $container['page'];
    
### enclose.php sample file
    require __DIR__ . '/bootstrap.php';
    $container['pagename'] = 'enclose.html';
    if (!$container['page']->isValid()) {
        $container['page']->enclose(function () {
            echo 'enclose page test';
        });
    }
    echo $container['page'];

License
-------

Copyright 2008-2018.

Licensed under the [GNU Lesser General Public License, Version 3.0](https://www.gnu.org/licenses/lgpl.txt)