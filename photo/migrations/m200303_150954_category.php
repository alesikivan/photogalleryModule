<?php

use yii\db\Migration;

/**
 * Class m200303_150954_category
 */
class m200303_150954_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('category', [
           'id' => $this->primaryKey(),
           'title' => $this->string(255),
           'slug' => $this->string(255),
           'status' => $this->string(255),
           'count' => $this->integer()->defaultValue(0),
     ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
        echo "m200303_150954_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200303_150954_category cannot be reverted.\n";

        return false;
    }
    */
}
