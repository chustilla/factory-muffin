<?php

namespace League\FactoryMuffin\Facades;

/**
 * This is the faker facade class.
 *
 * This class dynamically proxies static method calls to the underlying faker.
 *
 * @see League\FactoryMuffin\Faker
 *
 * @package League\FactoryMuffin\Facades
 * @author  Scott Robertson <scottymeuk@gmail.com>
 * @author  Graham Campbell <graham@mineuk.com>
 * @license <https://github.com/thephpleague/factory-muffin/blob/master/LICENSE> MIT
 */
class Faker
{
    /**
     * The underlying faker instance.
     *
     * @var \League\FactoryMuffin\Faker
     */
    private static $instance;

    /**
     * Get the underlying faker instance.
     *
     * We'll always cache the instance and reuse it.
     *
     * @return \League\FactoryMuffin\Faker
     */
    private static function instance()
    {
        if (!self::$instance) {
            self::$instance = new \League\FactoryMuffin\Faker();
        }

        return self::$instance;
    }

    /**
     * Reset the underlying faker instance.
     *
     * @return \League\FactoryMuffin\Faker
     */
    public static function reset()
    {
        self::$instance = null;

        return self::instance();
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @codeCoverageIgnore
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        switch (count($args)) {
            case 0:
                return self::instance()->$method();
            case 1:
                return self::instance()->$method($args[0]);
            case 2:
                return self::instance()->$method($args[0], $args[1]);
            case 3:
                return self::instance()->$method($args[0], $args[1], $args[2]);
            default:
                return call_user_func_array(array(self::instance(), $method), $args);
        }
    }
}
