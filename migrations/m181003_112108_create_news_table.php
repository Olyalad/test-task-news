<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m181003_112108_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'url' => $this->string()->notNull(),
            'title' => $this->string()->notNull()->comment('Заголовок'),
            'preview' => $this->text()->notNull()->comment('Анонс'),
            'text' => $this->text()->notNull()->comment('Текст'),
            'status' => $this->integer(4)->notNull()->defaultValue(1),
            'admin_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-news-url',
            'news', 'url',
            true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-news-url', 'news');
        $this->dropTable('news');
    }
}
