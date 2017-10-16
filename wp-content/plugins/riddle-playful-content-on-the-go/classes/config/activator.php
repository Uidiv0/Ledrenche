<?php
namespace Config;
class Activator{

    public static function activate(){
        global $wp_version, $required_php_version;
        $wp_version = get_bloginfo('version');
        $required_wp_version = RIDDLE_WP_VERSION;
        $required_php_version = RIDDLE_PHP_VERSION;
        $php_version    = phpversion();
        $php_compat     = version_compare( $php_version, $required_php_version, '>=' );
        $wp_compat      = version_compare($wp_version, $required_wp_version,'>=');
        $compat = '';
        $require_ssl = true;
        $require_curl = function_exists('curl_version');

        if ( !$php_compat ){
            $compat = sprintf( __( 'You cannot install because <strong>Riddle Plugin</strong> requires PHP version <strong>%1$s or higher</strong>. You are running version <strong>%2$s</strong>.' ),  $required_php_version, $php_version );
        }

        if(!$wp_compat){
            if($compat!='')$compat .= '<br />';
            $compat .= sprintf( __( 'You cannot install because <strong>Riddle Plugin</strong> requires Wordpress version <strong>%1$s or higher</strong>. You are running version <strong>%2$s</strong>.' ),  $required_wp_version, $wp_version );
        }

        if(!$require_curl){
            if($compat!='')$compat .= '<br />';
            $compat .= 'You cannot install because <strong>Riddle Plugin</strong> requires <strong>CURL</strong> module';
        }

        if(!OPENSSL_VERSION_NUMBER){
            if($compat!='')$compat .= '<br />';
            $compat .= 'You cannot install because <strong>Riddle Plugin</strong> requires <strong>OpenSSL</strong> module</p>';
            $require_ssl = false;
        }

        if ( !$php_compat || !$wp_compat || !$require_curl || !$require_ssl) {
           return __('<p>' . $compat . '</p> <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
        }

        return true;
    }

}