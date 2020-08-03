<?php

use yii\db\Migration;

/**
 * Class m200304_092603_image
 */
class m200304_092603_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('image', [
           'id' => $this->primaryKey(),
           'author' => $this->string(255),
           'category' => $this->string(255),
           'title' => $this->string(255),
           'date' => $this->datetime(),
           'status' => $this->string(255),
           'extension' => $this->string(255),
           'image' => $this->string(255),
           'key' => $this->string(255),
     ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
        echo "m200304_092603_image cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200304_092603_image cannot be reverted.\n";

        return false;
    }
    */
}
