<?php

namespace app\models;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property \DateTime $birth_date
 * @property integer $group_id
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_REQUEST =0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
}