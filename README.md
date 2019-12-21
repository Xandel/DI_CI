# DI_CI
这是一个整合了[CodeIgniter(v3.1.5)](https://codeigniter.com/)和[PHP_DI(v6.0.11)](http://php-di.org/)的Demo。通过PHP_DI，在不改动框架核心文件和不改变框架原有功能的前提下，让在CodeIgniter上构建的项目可以使用依赖注入。

您可以参考本Demo，通过以下几个步骤整合CI和PHP-DI：
1. composer install 或 composer update（composer.json的设置请参考本Demo的composer.json文件）；
2. 把框架核心扩展文件MY_Hooks.php安装到 application/core 路径下；
3. 把DI容器配置文件di.php安装到 application/config 路径下。

这样就可以了，您可以在控制器里使用依赖注入了。控制器的依赖以及依赖的依赖均由DI容器注入，实现了高度松耦合。

要注意的一点是，不能在控制器的构造函数里使用参数type-hint的方式注入依赖，建议使用属性注入。

详细解析请参看：https://zhuanlan.zhihu.com/p/98644060

Demo演示地址：http://andel.xlphp.net
