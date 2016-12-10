<?php
/**
 * Created by PhpStorm.
 * User: Хозяин
 * Date: 11.12.2016
 * Time: 16:44
 */

namespace app\models;

use Yii;
use yii\validators\UrlValidator;
use yii\db\Query;

class Compressor {
    public static $set = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
    const SHORT_URL_LENGTH = 6;

    /**
     * Генерация строки из 6 символов
     * @return string
     */
    public static function generate() {
        $url = null;

        $size = strlen(self::$set) - 1;
        $i = 0;
        while ($i++ < self::SHORT_URL_LENGTH) {
            $url .= self::$set[mt_rand(0, $size)];
        }
        return $url;
    }


    /**
     * @param $url
     * @return string
     * @throws \yii\db\Exception
     */
    public static function pack($url) {
        $success = false;
        $result = '';

        $url = trim(urldecode($url));
        if ((new UrlValidator())->validate($url)) {
            do {
                $compressed = self::generate();
                $ord = ord($compressed[0]);

                $query = (new Query())->select(['short_url', 'long_url'])->from("url_{$ord}")->where(['short_url' => $compressed])->orWhere(['long_url' => $url]);
                if ($query->count()) {
                    $row = $query->one();
                    if (stripslashes($row['long_url']) == $url) {
                        $compressed = $row['short_url'];
                        $success = true;
                    }
                } else {
                    $url = addslashes($url);
                    Yii::$app->db->createCommand("insert into url_{$ord} ( short_url, long_url ) values ('{$compressed}', '{$url}')")->execute();
                    $success = true;
                }
            } while (!$success);

            $result = Yii::$app->urlManager->createAbsoluteUrl($compressed);
        } else {
            $result = 'Некорректный URL';
        }

        return json_encode(['success' => $success, 'result' => $result]);
    }

    /**
     * @param $short_url
     * @return bool|string
     */
    public static function search($short_url) {
        $ord = ord($short_url[0]);
        $result = (new Query())->select(['long_url'])->from("url_{$ord}")->where(['short_url' => $short_url]);
        if($result->count()) {
            $row = $result->one();
            return stripslashes($row['long_url']);
        }
        return false;
    }
}