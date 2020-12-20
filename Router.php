<?php

class  Router
{
    //Таблица маршрутов
    public static $routes = [
        '' => [
            'controller' => 'Film',
            'action' => 'index',
        ],
        'AddFilm' => [
            'controller' => 'Film',
            'action' => 'addFilm',
        ],
        'DeleteFilm' => [
            'controller' => 'Film',
            'action' => 'deleteFilm',
        ],
        'Search' => [
            'controller' => 'Film',
            'action' => 'search',
        ],
        'ImportList' => [
            'controller' => 'Film',
            'action' => 'importList',
        ],
        'FilmDetails' => [
            'controller' => 'Film',
            'action' => 'filmDetails',
        ],
    ];

    public static $route = []; //Текущий маршрут

    public static function getRoute() {
        return self::$route;
    }

    public static function matchRoute($query = 0) {
        $query = preg_replace("/\?.*/", '', $query); //Удаляем в запросе часть после ?

        foreach (self::$routes as $key=>$value)
        {
            if ($query == $key) {
                self::$route = $value;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url) {
        $url = self::upperCamelCase($url);
        if (self::matchRoute($url)) {
            $controller = 'app\\Controllers\\' . self::$route['controller']."Controller";
            if (class_exists($controller)) {
                $cObj = new $controller(self::$route);
                $action = self::$route['action'];
//                $formValue = self::getValueForm();
                if (method_exists($cObj, self::$route['action'])) {
//                    $data = $cObj->$action($formValue);
                    if ($action == 'deleteFilm') {
                        $cObj->$action();
                        return;
                    }
                    $data = $cObj->$action();
                    $cObj->render($data);
                } else {
                    echo "Action \"" . self::$route['action'] . "\" недоступен";
                }

            } else {
                echo "Controller $controller no Found";
            }

        } else {
            include 'view/404.php';
        }
    }

    public static function upperCamelCase($name) {
        $name = str_replace(" ", "", ucwords(str_replace("-", " ", $name)));
        return $name;
    }

    private static function getValueForm() {
        if (!empty($_GET)) {
            $value = $_GET ?: null;
        }elseif(!empty($_POST['id'])){
//            var_dump($_POST);
            $value = $_POST['id'];
        } else {
            $value = null;
        }
//        var_dump($value);
//        var_dump($_GET);
        return $value;
    }
}