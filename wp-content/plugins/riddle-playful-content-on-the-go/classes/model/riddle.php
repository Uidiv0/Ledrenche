<?php
namespace Model;
use Core\Model;

class Riddle extends Model{

    /**
     * Get Riddle List
     * @param string $wp_token
     * @param array $options
     * @param int $page
     * @return array|mixed|object
     */
    public static function get_list($wp_token = null,$options = [],$page = 1){
        $endpoint = self::protocol(RIDDLE_URL.'apiv3/item/list');
        $query    = array(
            'forsale' => 'false',
            'purchased' => 'false',
            'type'  => 'all',
            'search' => '',
            'sort' => 'date',
            'page' => $page,
            'wp_token' => $wp_token,
            'q' => time()
        );
        $query += $options;
        if(is_null($wp_token)){
            unset($query['wp_token']);
        }

        $response = self::call($endpoint,$query,'get');

        $content  = json_decode($response['content']);
        if(is_object($content)){
            $content->endpoint = $response['endpoint'];
            $content->allow_url_fopen = $response['allow_url_fopen'];
        }

        if(is_null($content)){
            $content = [
                $response['allow_url_fopen'],
                $response['endpoint']
            ];
        }
        return $content;
    }

    /**
     * Get Riddle
     * @param $rid
     * @return array|mixed|object
     */
    public static function get($rid){
        $endpoint = self::protocol(RIDDLE_URL.'apiv3/item/get/'.$rid);
        $key = 'riddle_'.$rid;
        if(isset($_SESSION[$key])){
            $response = $_SESSION[$key];
        }else{
            $response = self::call($endpoint,[],'get');
            $_SESSION[$key] = $response;
        }
        return json_decode($response);
    }

    /**
     * Get site uri
     * @param $uri
     * @return string
     */
    public static function protocol($uri)
    {
        if (isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $protocol = 'https://';
        }
        else {
            $protocol = 'http:';
        }
        return $protocol.$uri;
    }

    public static function embed(array $query){
        $endpoint = self::protocol(RIDDLE_URL.'apiv3/embed/build?');

        $response = self::call($endpoint,$query,'get');

        return json_decode($response);
    }

}