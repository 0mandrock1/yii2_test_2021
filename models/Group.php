<?php

namespace app\models;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property string  $name
 * @property integer $parent_id
 */
class Group extends \yii\db\ActiveRecord
{
    public $youngest_user;
    public $oldest_user;
    public $avg_age;
    public $child_groups;

    const STATUS_REQUEST =0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }
}