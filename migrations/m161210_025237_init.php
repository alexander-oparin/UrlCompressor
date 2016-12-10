<?php

use yii\db\Migration;
use app\models\Compressor;

class m161210_025237_init extends Migration {
    public function up() {
        $set = Compressor::$set;
        $size = strlen($set)-1;
        $i = 0;
        while($i++ < $size) {
            $ord = ord($set[$i]);
            $this->execute("CREATE TABLE url_{$ord} (
                            `short_url` CHAR(6) NOT NULL,
                            `long_url` TEXT NOT NULL,
                            PRIMARY KEY (`short_url`)
                        )
                        COLLATE='utf8_general_ci'
                        ENGINE=InnoDb;");
        }
        return true;

    }

    public function down() {
        $set = Compressor::$set;
        $size = strlen($set)-1;
        $i = 0;
        while($i++ < $size) {
            $ord = ord($set[$i]);
            $this->execute("DROP TABLE IF EXISTS url_{$ord}");
        }
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
