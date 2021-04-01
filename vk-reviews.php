<?php 
/**
 * Plugin Name: Vk Feedback
 * Description: Отображение отзывов со стены ВКонтакте: [vk_reviews]vk reviews[/vk_reviews]
 * Plugin URI: https://github.com/AndreyTSpb/wp_plugin_yandex_map
 * Author: tynyany.ru
 * Version: 1.0.1
 * Author URI: http://tynyany.ru
 *
 * Text Domain: Vk Feedback
 *
 * @package Vk Feedback
 */
defined('ABSPATH') or die('No script kiddies please!');

define( 'WPVKRWS_VERSION', '1.0.1' );

define( 'WPVKRWS_REQUIRED_WP_VERSION', '5.5' );

define( 'WPVKRWS_PLUGIN', __FILE__ );

define( 'WPVKRWS_PLUGIN_BASENAME', plugin_basename( WPVKRWS_PLUGIN ) );

define( 'WPVKRWS_PLUGIN_NAME', trim( dirname( WPVKRWS_PLUGIN_BASENAME ), '/' ) );

define( 'WPVKRWS_PLUGIN_DIR', untrailingslashit( dirname( WPVKRWS_PLUGIN ) ) );

define( 'WPVKRWS_PLUGIN_URL',
	untrailingslashit( plugins_url( '', WPVKRWS_PLUGIN ) )
);

//Регистрация функций, выполняемых при активации и деактивации плагина
//register_activation_hook(__FILE__, 'wpvkrws_plugin_install');
//register_deactivation_hook(__FILE__, 'testplugin_uninstall');

if(is_admin()){
    require_once WPVKRWS_PLUGIN_DIR.'/admin/admin.php';
}else{
    require_once WPVKRWS_PLUGIN_DIR.'/frontend.php';
}
