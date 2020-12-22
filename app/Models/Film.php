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
    private $rules_date = ['min' => 1850, 'max' => 2020];
    static private $rules_format = ['DVD', 'VHS', 'Blu-Ray'];
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
                    $data[$i]['title'] = htmlspecialchars(trim(str_replace("Title:", "", $f)), ENT_QUOTES);
                } elseif (stripos($f, "releaseyear") !== false) {
                    $data[$i]['release_year'] = trim(str_replace("ReleaseYear:", "", $f));
                } elseif (stripos($f, "format") !== false) {
                    $data[$i]['format'] = trim(str_replace("Format:", "", $f));
                } elseif (stripos($f, "stars") !== false) {
                    $data[$i]['stars'] = htmlspecialchars(trim(str_replace("Stars:", "", $f)), ENT_QUOTES);
                }
            }
            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    if (empty($data[$key]['title']) || empty($data[$key]['release_year']) || empty($data[$key]['format']) ||
                        empty($data[$key]['stars']) || mb_strlen($data[$key]['release_year']) > 4 ||
                        !is_numeric($data[$key]['release_year'])) {
                        unset($data[$key]);
                    }
                }
                return $data;
            }
        }
        return false;
    }

    public function validate($data) {
        $error = null;

        if ($data['release_year'] < $this->rules_date['min'] ||  $data['release_year'] > $this->rules_date['max']) {
            $error .= "Not correct release year<br>";
        }

        if (!in_array($data['format'], self::$rules_format)) {
            $error .= "Not correct format<br>";
        }

        $data['stars'] = explode(",", $data['stars']);
        $data['stars'] = $this->checkDublicate($data['stars']);
        if (!empty($data['stars'])) {
            $error .=  "Dublicate stars: " . $data['stars'];
        }

        return $error === null ? null : $error ;
    }

    /**
     * @param array $data
     * @return string "list of duplicates"
     */
    private function checkDublicate($data) {
        $dublicate = "";

        foreach ($data as &$d) {
            $d = mb_strtolower(trim($d));
        }

        foreach (array_count_values ($data) as $key => $val) {
            if ($val > 1) $dublicate .= ucwords($key). ", " ;
        }

        return mb_substr($dublicate, 0, -1);
    }

    public  function ucwordsStars($stars) {
        return ucwords(mb_strtolower($stars));
    }

    public static function getFormats() {
        return self::$rules_format;
    }
}