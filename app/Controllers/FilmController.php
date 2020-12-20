<?php
/**
 * Created by PhpStorm.
 * User: fenix
 * Date: 17.12.2020
 * Time: 15:22
 */

namespace app\Controllers;

use app\Models\Film;

class FilmController extends Controller
{

    public function index()
    {
        $title = "List Films";
        $model = new Film();
        $res = $model->findAll();

        return compact('res', 'title');
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
        $model = new Film();
        $res = $model->findLike($search['radio'], $search['q']);

        return compact('res', 'search', 'title');
    }

    public function importList()
    {
        $title = "Import list";
        $fields = "title, release_year, format, stars";

        if (empty($_FILES)) {
            return compact('title');
        }

        $films = Film::CreateArrayImport();

        if (empty($films)) {
            return false;
        }

        $model = new Film();

        foreach ($films as $film) {
            $res = $model->create($fields, array_values($film));
        }

        return compact('res', 'title');
    }

    public function filmDetails()
    {
        $title = "Films details";
        $id = $_GET;
        $model = new Film();
        $res = $model->findOne($id['id']);

        return compact('res', 'title');
    }

    public function addFilm()
    {
        $title = "Add new film";

        if (empty($_POST)) {
            return false;
        }

        $model = new Film();
        $values = array_values($_POST);
        $fields = array_keys($_POST);
        $res = $model->check($fields, $values);

        if (!empty($res)) {
            $error = "Такой фильм уже есть в базе";
            return compact('title', 'error');
        }

        $fields = implode(',', $fields);
        $model->create($fields, $values);
        $success = "Фильм успешно добавлен";
        return compact('title', 'success');
    }
}