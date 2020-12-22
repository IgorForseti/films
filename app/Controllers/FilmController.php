<?php
/**
 * Created by PhpStorm.
 * User: fenix
 * Date: 17.12.2020
 * Time: 15:22
 */

namespace app\Controllers;

use app\Models\Film;
use app\Models\Model;


class FilmController extends Controller
{

    public function index()
    {
        if (isset($_GET['page']) && ($_GET['page'] == 1 || $_GET['page'] == 0)) {
                header("Location: /");
                exit;
        }

        $current_page = isset($_GET['page']) ?$_GET['page'] : 1;
        $title = "List Films";
        $model = new Film();
        $res = $model->findAll() ;

        if (empty($res)) {
            return compact('title');
        }

        $count_line = 2; // Число записей на странице
        $count_page = intval((count($res) - 1) / $count_line) + 1; //Всего страниц

        if ($count_page < $current_page) {
            http_response_code(404);
            include VIEW . '/404.php';
            exit;
        }

        if ($count_page > 1) {
            $res = $model->pagination($res, $count_line, $current_page);
        }

        return compact('res', 'title', 'current_page', 'count_page');
    }

    public function deleteFilm()
    {
        $id = $_POST['id'];
        $model = new Film($id);

        if (!empty($model->findOne($id))) {
            $model->delete($id);
        }
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }

    public function search()
    {
        $title = 'Search for a movie by';
        $search = $_GET;

        $current_page = isset($_GET['page']) ?: 1;
        $search['q'] = (htmlspecialchars($search['q'], ENT_QUOTES));
        $model = new Film();
        $res = $model->findLike($search['radio'], htmlspecialchars($search['q'], ENT_QUOTES));
        $all_search = count($res);
        if (empty($res)) {
            return compact('title', 'search');
        }

        $count_line = 2; // Число записей на странице
        $count_page = intval((count($res) - 1) / $count_line) + 1; //Всего страниц

        if ($count_page < $current_page) {
            http_response_code(404);
            include VIEW . '/404.php';
            exit;
        }

        if ($count_page > 1) {
            $res = $model->pagination($res, $count_line, $current_page);
        }

        return compact('res', 'title', 'current_page', 'count_page', 'search', 'all_search');
    }

    public function importList()
    {
        $title = "Import list";
        if (empty($_FILES)) {
            return compact('title');
        }

        $films = Film::CreateArrayImport();

        if (empty($films)) {
            return false;
        }
        foreach ($films as $film) {
            $this->addFilm($film);
        }

        return compact( 'title');
    }

    public function filmDetails()
    {
        $stars = [];
        $title = "Films details";
        $id = $_GET;
        $model = new Film();
        $res = $model->findOne($id['id']);
        $res[0]['stars'] = explode(",", $res[0]['stars']);

        foreach ($res[0]['stars'] as $key => $val) {
            $stars[$val] = str_replace(" ", "+", trim($val));
        }

        $res[0]['stars'] = $stars;

        return compact('res', 'title');
    }

    public function addFilm($importFilm = null)
    {
        $Film = $importFilm ?: $_POST;
        $title = "Add new film";
        $formats = Film::getFormats();

        if (empty($Film)) {
            return compact('title', 'formats');
        }
        $model = new Film();
        $values = Model::replaceSpecialChar($Film);
        $values['stars'] = $model->ucwordsStars($values['stars']);
        $fields = array_keys($Film);

        $res = $model->check($fields, array_values($values));

        if (!empty($res)) {
            $error = "Такой фильм уже есть в базе";
            return compact('title', 'error');
        }

        $validate = $model->validate($values);

        if (!empty($validate)) {
            $error = $validate;
            return compact('title', 'error', 'formats');
        }

        $fields = implode(',', $fields);
        $values = array_values($values);

        $model->create($fields, $values);
        $success = "Фильм успешно добавлен";
        return compact('title', 'success', 'formats');
    }
}