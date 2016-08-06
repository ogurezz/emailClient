<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `letters`.
 */
class m160803_155122_create_letters_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%letters}}',  [           
            'id'        => Schema::TYPE_PK,
            'email'     => Schema::TYPE_STRING.' NOT NULL',
            'subject'   => Schema::TYPE_STRING.' NOT NULL',
            'body'      => Schema::TYPE_TEXT.' NOT NULL',
            'send_at'   => Schema::TYPE_INTEGER.' NOT NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%letters}}');
    }
}
