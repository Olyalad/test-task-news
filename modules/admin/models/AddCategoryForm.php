<?php

namespace app\modules\admin\models;


use app\models\Category;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class AddCategoryForm extends Model
{
    public $name;
    public $parent_id;

    /** @var Category */
    private $category = null;

    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string', 'max' => 255],
            ['parent_id', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Наименование',
            'parent_id' => 'Родительская категория',
        ];
    }

    public function loadCategory($id)
    {
        $this->category = Category::findOne($id);
        if ($this->category == null)
            throw new NotFoundHttpException('The requested page does not exist.');

        $this->name = $this->category->name;

        $parent = $this->category->parents(1)->one();
        $this->parent_id = $parent ? $parent->id : null;
    }

    public function save()
    {
        if ($this->category == null)
            $this->insert();

        return $this->update();
    }

    public function insert()
    {
        $newCategory = new Category(['name' => $this->name]);

        if ($this->parent_id) {
            $categoryParent = Category::findOne($this->parent_id);
            return $newCategory->prependTo($categoryParent);
        } else {
            return $newCategory->makeRoot();
        }
    }

    public function update()
    {
        $updateCategory = $this->category;
        $updateCategory->name = $this->name;

        $updateCategory->deleteWithChildren();

        if ($this->parent_id) {
            $categoryParent = Category::findOne($this->parent_id);
            return $updateCategory->prependTo($categoryParent);
        } else {
            return $updateCategory->makeRoot();
        }
    }
}