<?php

use app\models\Category;
use yii\db\Migration;

/**
 * Class m181003_113452_add_test_records
 */
class m181003_113452_add_test_records extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $root = new Category(['name' => 'Политика']);
        $root->makeRoot();

        $child1 = new Category(['name' => 'Внешняя политика']);
        $child1->prependTo($root);

        $child2 = new Category(['name' => 'Внутренняя политика']);
        $child2->prependTo($root);

        $child3 = (new Category(['name' => 'Выборы']));
        $child3->prependTo($child2);

        $child3 = (new Category(['name' => 'Санкции']));
        $child3->prependTo($child2);

        $root = new Category(['name' => 'Спорт']);
        $root->makeRoot();

        $child1 = new Category(['name' => 'Хоккей']);
        $child1->prependTo($root);

        $child2 = new Category(['name' => 'НХЛ']);
        $child2->prependTo($child1);

        $child2 = new Category(['name' => 'КХЛ']);
        $child2->prependTo($child1);

        $child2 = new Category(['name' => 'ЧМ мира']);
        $child2->prependTo($child1);

        $child1 = new Category(['name' => 'Футбол']);
        $child1->prependTo($root);

        $catIdsArray = Category::find()->select('id')->column();

        $faker = Faker\Factory::create();

        for ($i = 1; $i < 33; ++$i) {
            $date = $faker->dateTimeThisYear->getTimestamp();
            $title = $faker->sentence();
            $url = str_replace([' ', '.', ',', ':', ';'], ['_', ''], $title);
            $url = strtolower($url);

            $this->insert('news', [
                'category_id' => $catIdsArray[array_rand($catIdsArray)],
                'url' => $url,
                'title' => $title,
                'preview' => $faker->sentences(3, true),
                'text' => $faker->realText(1000, 3),
                'admin_id' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('comment');
        $this->delete('news');
        $this->delete('category');
    }

}
