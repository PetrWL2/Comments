<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $article_id
 * @property string $text
 * @property string $name
 * @property string $email
 * @property string $created_at
 * @property string $path
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'text', 'article_id'], 'required'],
            [['article_id'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'safe'],
            [['name', 'email', 'path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'text' => 'Text',
            'name' => 'Name',
            'email' => 'Email',
            'created_at' => 'Created At',
            'path' => 'Path',
        ];
    }
    
    public function getLevel()
    {
        return substr_count($this->path, '.')-1;
    }
    
    public function getFormatedText()
    {
        return  preg_replace('/((www|http:\/\/)[^ ]+)/', '<a href="\1">\1</a>', $this->text);
    }
}
