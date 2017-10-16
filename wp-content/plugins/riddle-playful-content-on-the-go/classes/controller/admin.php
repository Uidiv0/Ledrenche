<?php
namespace Controller;
use Core\View;
use Model\Riddle as RiddleModel;

class Admin{
    /**
     * The ID of this plugin.
     *
     * @var string  $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @var string  $version    The current version of this plugin.
     */
    private $version;
    /**
     * The configs
     * @var array $configs
     */
    private static $_configs;

    private $loader;
    /**
     * @param Loader $loader
     */
    public function __construct(Loader $loader) {
        //include the admin menu function
        $this->plugin_name = RIDDLE_PLUGIN_NAME;
        $this->version = RIDDLE_PLUGIN_VERSION;
        $this->loader  = $loader;
    }
    /**
     * Register the stylesheets for the admin area.
     *
     */
    public function enqueue_styles() {

        wp_enqueue_style($this->plugin_name, RIDDLE_URL_ASSET . 'css/admin.css', array(), $this->version, 'all' );
    }

    /**
     * Register the JavaScript for the admin area.
     *
     */
    public function enqueue_scripts() {

        wp_enqueue_script($this->plugin_name, RIDDLE_URL_ASSET . 'js/riddle.js', array( 'jquery' ), $this->version, false );
    }

    /**
     * Register the admin menu
     */
    public function configs() {

        // Add a new top-level menu (ill-advised):
        add_menu_page(__('My Riddles','riddle-admin-menu'), __('My Riddles','riddle-admin-menu'), 'manage_options', 'riddle-list', 'Controller\Admin::page_riddle_list' );

        add_submenu_page('riddle-list',__('Create Riddle','riddle-admin-menu'), __('Create Riddle','riddle-creation'), 'manage_options', 'riddle-creation', 'Controller\Admin::creation');
        add_submenu_page('riddle-list', __('Account Settings','riddle-admin-menu'), __('Account Settings','riddle-admin-menu'), 'manage_options', 'riddle-settings', 'Controller\Admin::page_riddle_settings');
    }
    
    public static function page_riddle_create(){
        return self::creation();
    }

    /**
     * Get Riddle list
     */
    public static function page_riddle_list(){
        $wpToken = Riddle::instance()->get_configs();
        $list = RiddleModel::get_list(
            isset($wpToken['user']['wp_token'])?$wpToken['user']['wp_token']:'',
            array(),
            isset($_GET['page_number'])?$_GET['page_number']:1
        );

        $riddles = array();
        $pagination = array();
        if(isset($list->items)){
            foreach($list->items as $k=>$riddle){
                if($riddle->status == 'draft'){
                    $title = $riddle->draftData->title?$riddle->draftData->title:'(untitled)';
                    $image = $riddle->draftData->image->thumb;
                    $lastAction = 'Last saved: ';
                }else{
                    $title = $riddle->data->title?$riddle->data->title:'(untitled)';
                    $image =$riddle->data->image->thumb;
                    $lastAction = 'Published: ';
                }
                if($image == ''){
                    $image = '//res.cloudinary.com/riddle/image/upload/stock/share-'.$riddle->type.'.jpg';
                }else{
                    if(!preg_match('/.\:\/\/res.cloudi+?/',$image)){
                        $image = RIDDLE_URL.$image;
                    }
                }
                $lastAction .= date('d/m/Y H:i A');

                $riddles[] = array(
                    'title'     => $title,
                    'status'    => $riddle->status,
                    'type'      => $riddle->type,
                    'image'     =>  $image,
                    'edit'      => '?page=riddle-creation&rid='.$riddle->uid,
                    'preview'   => '?page=riddle-preview&rid='.$riddle->uid,
                    'action'    => $lastAction
                );
            }
            $pagination = $list->pagination;
        }

        View::render('admin/index',array(
            'title'         => __('My Riddles', 'riddle-list'),
            'configs'       => Riddle::instance()->get_configs(),
            'riddles'       => $riddles,
            'pagination'    => $pagination
        ));
    }

    /**
     * Riddle settings
     * Phase 1 : only save wp token. Get from riddle directly
     */
    public static function page_riddle_settings(){
        $configs = Riddle::instance()->get_configs();

        if(isset($_POST['token'])){
            $configs['user']['wp_token'] = $_POST['token'];
            Riddle::instance()->save_configs(self::$_configs);
        }

        View::render('admin/setting',array(
            'title'     => __('Account settings', 'riddle-settings'),
            'configs'   => $configs,
            'logo'      => RIDDLE_URL_ASSET.'/img/logo.png'
        ));
    }

    /**
     * Show Riddle Creation
     */
    public static function creation(){
        $wpToken = Riddle::instance()->get_configs();
        if(isset($_GET['rid'])){
            View::render('admin/edit',array(
                'title' => __('Riddle Edit','riddle-edit'),
                'token' => $wpToken['user']['wp_token'],
                'rid'   => $_GET['rid']
            ));
        }else{
            View::render('admin/creation',array(
                'title' => __('Riddle Creation','riddle-creation'),
                'token' => $wpToken['user']['wp_token']
            ));
        }
    }

    /**
     * Short code for edit riddle
     * @param $attr
     * @return string
     */
    public static function sc_riddle_edit($attr){
        $iframe = '<iframe src="'.RIDDLE_URL.'edit/create/'.$attr['id'].'?token='.$attr['token'].'&wordpress=1"
         width="100%" height="500px"></iframe>';

        return $iframe;
    }

    /**
     * @deprecated
     * Short code for Riddle view
     * @param $attr
     * @return string
     */
    public function sc_riddle_view($attr){
        $embed = '<div class="riddle_target" data-url="'.RIDDLE_URL.'a/'.$attr['id'].'" style="margin:0 auto;max-width:640px;">
                    <div style="display:none">
                    <section><h2>'.$attr['title'].'</h2>
                    <p><div>'.$attr['desc'].'</div></p>
                    </section><section></section></div>
                    <div class="rid-load" style="background:#000 url('.RIDDLE_URL.'assets/img/loader.gif) no-repeat center/10%;padding-top:56%;border-radius:5px"></div></div>
                    <script src="'.RIDDLE_URL.'files/js/embed.js"></script>';
        return $embed;
    }

    public function riddle_tinymce_button() {

        // Check if user have permission
        if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
            return;
        }
    }

    /**
     * @param $plugins
     * @return mixed+
     */
    public function riddle_tinymce_plugin($plugins){
        $plugins['riddle_mce_button'] = RIDDLE_URL_ASSET . 'js/riddle.tinymce.js?v='.$this->version;
        return $plugins;
    }

    /**
     * @param $buttons
     * @return mixed
     */
    public function riddle_register_tinymce_button($buttons){
        array_push( $buttons,'riddle_mce_button');
        return $buttons;
    }

    /**
     * @param $init
     */
    public function riddle_tinymce_init($init){
        $init['extended_valid_elements'] .= 'script[src]';
    }
    /**
     *
     */
    public static function get_riddle_list(){
        $wpToken = Riddle::instance()->get_configs();
        $list = RiddleModel::get_list(
            isset($wpToken['user']['wp_token'])?$wpToken['user']['wp_token']:'',
            array(
                'status' => 'published'
            ),
            isset($_GET['page_number'])?$_GET['page_number']:1
        );

        $riddles = array();
        $pagination = array();
        if(isset($list->items)){
            foreach($list->items as $k=>$riddle){
                if($riddle->status == 'draft'){
                    $title = $riddle->draftData->title?$riddle->draftData->title:'(untitled)';
                    $image = $riddle->draftData->image->thumb;
                    $lastAction = 'Last saved: ';
                }else{
                    $title = $riddle->data->title?$riddle->data->title:'(untitled)';
                    $image =$riddle->data->image->thumb;
                    $lastAction = 'Published: ';
                }
                if($image == ''){
                    $image = '//res.cloudinary.com/riddle/image/upload/stock/share-'.$riddle->type.'.jpg';
                }else{
                    if(!preg_match('/.\:\/\/res.cloudi+?/',$image)){
                        $image = RIDDLE_URL.$image;
                    }
                }
                $lastAction .= date('d/m/Y H:i A');

                $riddles[] = array(
                    'id'        => $riddle->uid,
                    'title'     => $title,
                    'status'    => $riddle->status,
                    'type'      => $riddle->type,
                    'image'     =>  $image,
                    'edit'      => '?page=riddle-creation&rid='.$riddle->uid,
                    'preview'   => '?page=riddle-preview&rid='.$riddle->uid,
                    'addToBox'  => get_site_url(null,'wp-admin/admin_ajax.php?'),
                    'action'    => $lastAction
                );
            }
            $pagination = $list->pagination;
        }

        $response = array(
            'riddles' => $riddles,
            'paginations' => $pagination,
            'list' => $list
        );

        if(isset($list->success)){
            $response['message'] = $list->message;
        }

        echo json_encode($response);
        exit;
    }


    /**
     * @param $actions
     * @param string $action
     * @return Loader
     */
    public function add($actions,$action = 'add_action'){
        foreach($actions as $k=>$v){
            $this->loader->{$action}($v[0],$v[1],$v[2]);
        }

        return $this->loader;
    }
}