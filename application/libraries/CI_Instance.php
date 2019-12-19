<?php

namespace App\libraries;

/**
 * 为了方便后期维护，对框架原生函数get_instance()进行封装
 */
class CI_Instance
{
	private function __construct(){}
	
	private static $ci;

    /**
     * 取得CodeIgniter实例，以便使用框架资源
     * @return [CI_Controller] CodeIgniter实例
     */
    public static function &get_instance()
    {
    	if (self::$ci == NULL) {
            self::$ci = & get_instance();
    	}
        return self::$ci;
    }
}
