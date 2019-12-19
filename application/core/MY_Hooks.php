<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Hooks extends CI_Hooks {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The instance of DI ContainerBuilder
     * @var [DI\ContainerBuilder] 用于存放容器建造器实例(单例)
     */
    private static $di_container_builder;

    /**
     * The instance of CI_Controller
     * @var [CI_Controller]  CodeIgniter 对象(单例)
     */
    private static $ci;

	/**
	 * Call Hook
	 *
	 *
	 * @uses	CI_Hooks::_run_hook()
	 *
	 * @param	string	$which	Hook name
	 * @return	bool	TRUE on success or FALSE on failure
	 */
	public function call_hook($which = '')
	{
		if ($which === 'post_controller_constructor') 
		{
		    // 重载 Controller实例$CI，改由DI容器生成，从而在所有控制器中实现依赖注入
		    global $CI, $class;	
		    
		    // 实例化构建器
			if (self::$di_container_builder == NULL) {
			    self::$di_container_builder = new DI\ContainerBuilder;
			}
            // 由于实现依赖注入后，为了实现松耦合，控制器不再继承CI_Controller，但为了仍可以访问 CodeIgniter资源，需要实例化CI_Controller类
			if (self::$ci == NULL) {
		        self::$ci = new CI_Controller;
			}
			// 构建DI容器
            $container = self::$di_container_builder->addDefinitions(APPPATH.'config/di.php')->build();
            // 取得控制器实例
			$CI = $container->get($class);
		}

		/**
		 * 以下与父类call_hook方法一致
		 */
		if ( ! $this->enabled OR ! isset($this->hooks[$which]))
		{
			return FALSE;
		}

		if (is_array($this->hooks[$which]) && ! isset($this->hooks[$which]['function']))
		{
			foreach ($this->hooks[$which] as $val)
			{
				$this->_run_hook($val);
			}
		}
		else
		{
			$this->_run_hook($this->hooks[$which]);
		}

		return TRUE;
	}

}

