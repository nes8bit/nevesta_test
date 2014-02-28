<?php 
class Autoloader
{
    public function __construct()
    {
        spl_autoload_register(array($this, 'modelAutoloader'));
        spl_autoload_register(array($this, 'classAutoloader'));
    }

    public function classAutoloader($className)
    {
        include __DIR__.'/'.$className.'.php';
    }

    public function modelAutoloader($className)
    {
        include __DIR__.'/models/'.$className.'.php';
    }
}
