<?php
namespace Controller;
use Model\Riddle as RiddleModel;

class Front{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     */
    public function __construct() {

        $this->plugin_name = RIDDLE_PLUGIN_NAME;
        $this->version = RIDDLE_PLUGIN_VERSION;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Riddle_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Riddle_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, RIDDLE_URL_ASSET . 'css/front.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Riddle_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Riddle_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script( $this->plugin_name, RIDDLE_URL . 'files/js/embed.js', array(  ), $this->version, 'all' );
    }

    /**
     * Short code for Riddle view
     * @param $attr
     * @return string
     */
    public static function sc_riddle_view($attr){
        $wpToken = Riddle::instance()->get_configs();
        $query = array(
            'id' => $attr['id'],
            'mode' => isset($attr['mode'])?$attr['mode']:'dynamic',
            'maxWidth'=> isset($attr['max-width'])?$attr['max-width']:'',
            'seo' => isset($attr['seo'])?$attr['seo']:'',
            'heightPx' => isset($attr['height-px'])?$attr['height-px']:'',
            'heightPc' => isset($attr['height-pc'])?$attr['height-pc']:'',
            'wpToken' => $wpToken['user']['wp_token']
        );

        foreach($query as $k=>$v){
            if($v==''){
                unset($query[$k]);
            }
        }

        $request = wp_remote_get(RIDDLE_URL.'apiv3/embed/build?'.http_build_query($query));
        $embed = wp_remote_retrieve_body($request);

        if($embed){
            $embed = json_decode($embed);
        }
        
        return isset($embed->embed)?$embed->embed:'';
    }

}