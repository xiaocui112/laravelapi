<?php

return array(

    /*
     * 后台的url入口
     *
     * @type string
     */
    'uri' => 'admin',

    /*
     *  Domain for routing.
     *
     *  @type string
     */
    'domain' => '',

    /*
     * 页面标题
     *
     * @type string
     */
    'title' => config('app.name', "后台管理"),

    /*
     * 模型配置目录的路径
     *
     * @type string
     */
    'model_config_path' => config_path('administrator'),

    /*
     * 设置配置目录的路径
     *
     * @type string
     */
    'settings_config_path' => config_path('administrator/settings'),

    /*
     网站的菜单结构对于模型，应提供模型配置文件的名称或模型配置的名称数组
*文件。这同样适用于设置配置文件，但必须在设置配置文件名前面加上“settings.”。您还可以添加
*通过在视图路径前面加上“page.”来自定义页面通过提供名称数组，可以对某些模型或设置页进行分组
*一起。每个名称都需要在模型配置路径中有一个配置文件、具有相同名称的设置配置路径或
*完全合格的拉瓦维尔景观。所以“users”需要在模型配置路径中有一个“users.php”文件，“settings.site”需要一个
*设置配置路径中的“site.php”文件和“page.foo.test”需要“foo”目录中的“test.php”或“test.blade.php”文件
*在视图目录中。
     *
     * @type array
     *
     * 	array(
     *		'E-Commerce' => array('collections', 'products', 'product_images', 'orders'),
     *		'homepage_sliders',
     *		'users',
     *		'roles',
     *		'colors',
     *		'Settings' => array('settings.site', 'settings.ecommerce', 'settings.social'),
     * 		'Analytics' => array('E-Commerce' => 'page.ecommerce.analytics'),
     *	)
     */
    'menu' => [
        '用户于权限' => [
            'users',
        ],
    ],

    /*
     *permission选项是最高级别的身份验证检查，允许您定义一个闭包，如果当前用户
*允许查看管理部分。任何“错误”响应都会将用户发送回下面定义的“login'u path”。
     *
     * @type closure
     */
    'permission' => function () {
        // 只要是能管理内容的用户，就允许访问后台
        return Auth::check() && Auth::user()->can('manage_contents');
    },

    /*
     *这决定了您将拥有一个仪表板（在仪表板视图选项中提供其视图）还是一个非仪表板主页
*页面（在主页选项中提供其菜单项）
     *
     * @type bool
     */
    'use_dashboard' => false,

    /*
     *如果要创建仪表板视图，请在此处提供视图字符串。
     *
     * @type string
     */
    'dashboard_view' => '',

    /*
     *应用作管理节的默认登录页的菜单项
     *
     * @type string
     */
    'home_page' => 'users',

    /*
*当用户单击“返回站点”按钮时将被带到的路径
     *
     * @type string
     */
    'back_to_site_path' => '/',

    /*
     *登录路径是管理员在未通过权限检查时向用户发送的路径
     *
     * @type string
     */
    'login_path' => 'login',

    /*
     * 注销路径是管理员单击注销链接时向用户发送消息的路径
     *
     * @type string
     */
    'logout_path' => false,

    /*
     *这是与重定向到登录操作一起发送的返回路径的密钥。session：：get（'redirect'）将保留返回url。
     *
     * @type string
     */
    'login_redirect_key' => 'redirect',

    /*
     * Global default rows per page
     *
     * @type int
     */
    'global_rows_per_page' => 20,

    /*
     * An array of available locale strings. This determines which locales are available in the languages menu at the top right of the Administrator
     * interface.
     *
     * @type array
     */
    'locales' => [],

    'custom_routes_file' => app_path('Http/routes/administrator.php'),
);
