<?php
/**
 * Plugin Name:       Riddle (Official)
 * Plugin URI:        https://creation.riddle.com
 * Description:       Questionare plugin for riddle.com games
 * Version:           1.0.0
 * Author:            TechArtLove.com
 * Author URI:        http://TechArtLove.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Riddle (Official)
 * Domain Path:       /
 */
namespace Controller;
use Core\Controller;

class Riddle extends Controller{
    /**
     * Single object
     * @var null $_instance
     */
    protected static $_instance = null;

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     * @var Riddle_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;
    /**
     * The unique identifier of this plugin.
     * @var string $riddle  The string used to uniquely identify this plugin.
     */
    protected $riddle;

    /**
     * The admin object.
     * @var object
     */
    public $admin;

    protected function __construct() {
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Riddle single object
     * @return Riddle|null
     */
    public static function instance(){
        if(is_null(self::$_instance)){
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * @access   private
     */
    private function load_dependencies() {
        $this->loader = new Loader();
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     */
    private function define_admin_hooks() {
        $plugin_admin = new Admin($this->loader);
        // add admin actions
        $actions = array(
            array('admin_head',$plugin_admin, 'riddle_tinymce_button'),
            array('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles'),
            array('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts'),
            array('admin_menu', $plugin_admin,'configs'),
            array('wp_ajax_get_riddle_list',$plugin_admin,'get_riddle_list')
        );
        $this->loader = $plugin_admin->add($actions,'add_action');

        // add shortcodes
        $short_codes = array(
            array('rid-edit', $plugin_admin,'sc_riddle_edit'),
            array('rid-view', $plugin_admin,'sc_riddle_view')
        );
        $this->loader = $plugin_admin->add($short_codes,'add_shortcode');

        // add filters
        $filters = array(
            array('mce_external_plugins',$plugin_admin,'riddle_tinymce_plugin'),
           // array('mce_buttons', $plugin_admin, 'riddle_register_tinymce_button'),
            array('mce_before_init',$plugin_admin,'riddle_tinymce_init')
        );
        $this->loader = $plugin_admin->add($filters,'add_filter');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     */
    private function define_public_hooks() {
        $plugin_public = new Front();
        $this->loader->add_action( 'wp_enqueue_scripts',  $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        $this->loader->add_shortcode('rid-view', $plugin_public,'sc_riddle_view');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     */
    public function run(){
        $this->loader->run();
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Get configs
     * @return array|mixed|object
     */
    public function get_configs(){
        $configs = require RIDDLE_PATH_CONFIG.'configs.php';
        $configs = json_decode($configs,true);
        if($_POST){
            if(isset($_POST['user']['wp_token'])){
                $configs['user']['wp_token'] = $_POST['user']['wp_token'];
                $this->save_configs($configs);
            }
        }

        return $configs;
    }

    /**
     * Save configs
     * @param $configs
     * @return int
     */
    public function save_configs($configs){
        $success = file_put_contents(
            RIDDLE_PATH_CONFIG.'configs.php',
            "<?php return '".json_encode($configs)."';"
        );
        return $success;
    }
}
