<?php 
/**
 * Plugin Name: Vk Feedback
 * Description: WordPress плагин для отображения отзывов со страницы ВКонтакте (где применялся плагин feedback_kupiapp)
 * Плагин делается для отображения отзывов из групп Вконтакте, где применялось приложение "Feadback(Отзывы)", от разработчика KupiAPP.
 * Ссылка на страницу приложения <https://vk.com/feedback_kupiapp>
 * Plugin URI: https://github.com/AndreyTSpb/wp-vk-feedback-kupiapi
 * Author: Andrey Tynyany
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
