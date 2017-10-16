<?php
namespace Core;
class Model{
    /**
     * Function request
     * @param string $endpoint Url request
     * @param array $query
     * @param string $method
     * @return array|mixed
     * @throws \Exception
     */
    public static function call($endpoint,$query,$method){

        if(!$endpoint){
            die('Uri endpoint not valid');
        }

        if($method=='get' && !is_null($query)){
            $query 	   = http_build_query($query,null,'&');
            $endpoint .= '?'.$query;
            if(preg_match('/^http:/',$endpoint)){
                $endpoint = str_replace('http:','http:',$endpoint);
            }
        }

        $request = wp_remote_get($endpoint);
        $content = wp_remote_retrieve_body($request);
        return [
            'endpoint' => $endpoint,
            'content'  => $content,
            'allow_url_fopen' => ini_get('allow_url_fopen') ? 'Enabled' : 'Disabled'
        ];
    }

}