<?php
/**
 * Plugin Name:       Riddle - unlimited quiz creator with email capture
 * Plugin URI:        https://wordpress.org/plugins/riddle-playful-content-on-the-go/
 * Description:       Create quizzes, polls, personality tests and more right inside Wordpress. Grow your email list with built in lead generation tools.
 * Version:           3.11
 * Author:            riddle.com
 * Author URI:        https://www.riddle.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Riddle
 * Domain Path:       /
 * Minimum PHP :      5.4
 */
define('RIDDLE_PATH_CLASSES',plugin_dir_path(__FILE__).'classes/');
define('RIDDLE_PATH_CONTROLLER',plugin_dir_path(__FILE__).'/classes/controller/');
define('RIDDLE_PATH_MODEL',plugin_dir_path(__FILE__).'/classes/model/');
define('RIDDLE_PATH_CONFIG',plugin_dir_path(__FILE__).'/classes/config/');
define('RIDDLE_PATH_CORE',plugin_dir_path(__FILE__).'/classes/core/');
define('RIDDLE_PATH_VIEW',plugin_dir_path(__FILE__).'/view/');
define('RIDDLE_PATH_ASSET',plugin_dir_path(__FILE__).'/assets/');
define('RIDDLE_URL_ASSET',plugin_dir_url(__FILE__).'assets/');
define('RIDDLE_WP_VERSION','4.5');
define('RIDDLE_PHP_VERSION','5.4');
define('RIDDLE_PLUGIN_NAME','Riddle');
define('RIDDLE_PLUGIN_VERSION','3.11');

if (!file_exists(__DIR__ . '/env.php')) {
    define('RIDDLE_URL','https://www.riddle.com/');
} else {
    require_once 'env.php';
}

/**
 * Function for do something before plugin activated
 */
function activate_riddle() {
   if(!is_plugin_active(RIDDLE_PLUGIN_NAME)){
       $result = \Config\Activator::activate();
       if($result!==true){
           wp_die($result);
       }
   }
}

/**
 * Function for do something before plugin deactivate.
 */
function deactivate_riddle() {
    \Config\Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_riddle' );
register_deactivation_hook( __FILE__, 'deactivate_riddle' );

/**
 * The autoload class function
 */
spl_autoload_register('riddle_autoload');
function riddle_autoload($class){
    $path = strtolower(str_replace('_','/',$class)).'.php';
    $path = strtolower(str_replace('\\','/',$path));
    if(file_exists(RIDDLE_PATH_CLASSES.$path)){
        require_once RIDDLE_PATH_CLASSES.$path;
        return true;
    }
}
// Run riddle
\Controller\Riddle::instance()->run();
