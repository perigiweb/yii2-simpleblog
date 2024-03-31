<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m240331_061637_initial
 */
class m240331_061637_initial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('user', [
        'id' => $this->primaryKey(20),
        'email' => $this->string()->notNull(),
        'password' => $this->string()->notNull(),
        'name' => $this->string(64)->notNull(),
        'slug' => $this->string()->notNull(),
        'auth_key' => $this->string(32)->null(),
        'verify_code' => $this->string(16)->null(),
        'status' => $this->tinyInteger(1)->defaultValue(0),
        'created_at' => $this->dateTime(),
        'updated_at' => $this->dateTime(),
      ]);

      $this->createIndex('user_email', 'user', 'email', true);
      $this->createIndex('user_slug', 'user', 'slug', true);

      $this->createTable('post', [
        'id' => $this->primaryKey(20),
        'user_id' => $this->integer(20)->null(),
        'title' => $this->string(200)->notNull(),
        'content' => $this->text()->notNull(),
        'slug' => $this->string()->notNull(),
        'views' => $this->integer(11)->defaultValue(0),
        'created_at' => $this->dateTime(),
        'updated_at' => $this->dateTime(),
      ]);

      $this->createIndex('post_author', 'post', 'user_id');
      $this->createIndex('post_slug', 'post', 'slug', true);

      $this->addForeignKey('idx-fk-post-author', 'post', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240331_061637_initial cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240331_061637_initial cannot be reverted.\n";

        return false;
    }
    */
}
