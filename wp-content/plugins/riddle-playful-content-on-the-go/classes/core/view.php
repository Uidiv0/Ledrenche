<?php
namespace Core;
class View{

    /**
     * Render the view
     * @param string $view
     * @param null $options
     */
    public static function render($view = 'admin/index',$options = null){
        if(!is_null($options)){
            extract($options);
        }

        require RIDDLE_PATH_VIEW.$view.'.php';
    }

}