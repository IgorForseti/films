<?php
/**
 * Created by PhpStorm.
 * User: fenix
 * Date: 18.12.2020
 * Time: 11:28
 */

namespace app\Controllers;


abstract class Controller
{
    public $route = [];
    public $view;
    public $layout;

    public function __construct($route, $layout = "")
    {
        $this->route = $route;
        $this->view = $route['action'];
//        include VIEW . $route['controller'] . "/".$this->view . ".php";
        $this->layout = $layout ? LAYOUTS . "$layout.php" : LAYOUTS . "default.php";
    }

    public function render($data) {
        $this->view != "deleteFilm" ?: 'index';
        $file_view = APP . "view/" . $this->route['controller'] . "/" . $this->view . ".php";
        ob_start();
        if (file_exists($file_view)) {
            require $file_view;
        } else {
            echo "Не найден вид $file_view";
        }
        $content = ob_get_contents();
        ob_end_clean();

        if(is_file($this->layout)) {
            require $this->layout;
        }else{
            echo "Не найден шаблон: $file_view";
        }
    }
}