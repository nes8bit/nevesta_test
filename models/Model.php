<?php
/**
 * Class Model
 * @author Maxim Novikov <mnovikov.work@gmail.com>
 */
class Model
{
    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->{$method}();
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value) 
    {
        $this->$name = $value;
    }  
}
