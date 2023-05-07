<?php
spl_autoload_register(function ($className) {
    $expload = explode("\\", $className);
    $implod = implode('/', $expload);
    $location = __DIR__ . DIRECTORY_SEPARATOR . $implod . '.php';
    if (file_exists($location)) {
        require_once $location;
    } else {
        die('ERR:class not exist');
    }
});
?>
