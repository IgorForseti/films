<?php
/**
 * Created by PhpStorm.
 * User: fenix
 * Date: 18.12.2020
 * Time: 23:50
 */

namespace app\Models;


class Film extends Model
{
    public $table = 'films';
    public $orderField = 'title';

    /**
     * Формирует массив фильмов для записи в БД из текстового файла
     * @return array
     */
    public static function CreateArrayImport()
    {
        $tmp_array = file($_FILES['import']['tmp_name'], FILE_IGNORE_NEW_LINES);
        $i = -1;

        if (is_file($_FILES['import']['tmp_name'])) {
            foreach ($tmp_array as $f) {
                if (stripos($f, "title:") !== false) {
                    $i++;
                    $data[$i]['title'] = trim(str_replace("Title:", "", $f));
                } elseif (stripos($f, "releaseyear") !== false) {
                    $data[$i]['release_year'] = trim(str_replace("ReleaseYear:", "", $f));
                } elseif (stripos($f, "format") !== false) {
                    $data[$i]['format'] = trim(str_replace("Format:", "", $f));
                } elseif (stripos($f, "stars") !== false) {
                    $data[$i]['stars'] = trim(str_replace("Stars:", "", $f));
                }
            }

            foreach ($data as $key => $value) {
                if (empty($data[$key]['title']) || empty($data[$key]['release_year']) || empty($data[$key]['format']) ||
                    empty($data[$key]['stars']) || mb_strlen($data[$key]['release_year']) > 4 ||
                    !is_numeric($data[$key]['release_year'])) {
                    unset($data[$key]);
                }
            }
            return $data;
        }
        return false;
    }
}