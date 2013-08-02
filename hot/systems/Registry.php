<?php

class Registry
{

    private static $r = [];

    public static function add($name, $object)
    {
        if (!array_key_exists($name, self::$r)) {
            self::$r[$name] = $object;
        }
    }

    public static function get($name)
    {
        if (array_key_exists($name, self::$r)) {
            return self::$r[$name];
        } else {
            return null;
        }
    }

    public static function del($name)
    {
        if (array_key_exists($name, self::$r)) {
            unset(self::$r[$name]);
        }
    }

}

?>