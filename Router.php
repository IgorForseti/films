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
                if (method_exists($cObj, self::$route['action'])) {
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
            http_response_code(404);
            include VIEW.'/404.php';
        }
    }

    public static function upperCamelCase($name) {
        $name = str_replace(" ", "", ucwords(str_replace("-", " ", $name)));
        return $name;
    }
}