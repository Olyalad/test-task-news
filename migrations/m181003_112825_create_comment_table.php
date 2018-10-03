<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m181003_112825_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'status' => $this->integer(4)->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comment');
    }
}
