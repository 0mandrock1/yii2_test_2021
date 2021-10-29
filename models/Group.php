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



    /**
     * Method, which fills properties with child groups
     */
    public function childGroups() {
        $child_groups = self::find()
            ->where([ 'parent_id' => $this->id ])
            ->all();
        $this->child_groups = $child_groups;
    }

    /**
     * Method, which fills properties with information about group users age info
     */
    private function groupUserAges() {
        $users = User::find()
            ->where([ 'group_id' => $this->id])
            ->asArray()
            ->all();
        $age_info = User::age($users);
        $this->youngest_user = $age_info['youngest_user'];
        $this->oldest_user = $age_info['oldest_user'];
        $this->avg_age = $age_info['avg_age'];
    }


}