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

    public static function age( array $users ) {
        if (!empty($users)) {
            $user_ages = array();
            $min_max_age = array(
                'min' => [
                    'email' => '',
                    'age'=> 99
                ],
                'max' => [
                    'email' => '',
                    'age'=> 0
                ]
            );
            foreach ($users as $user) {

                $birth_date = new \DateTime($user['birth_date']);
                $now = new \DateTime('now');
                $diff = $now->diff($birth_date);
                $user_age = $diff->y;
                $user_ages[] = $user_age;

                if( $user_age > $min_max_age['max']['age'] ) {
                    $min_max_age['max'] = [
                        'email'  => $user['email'],
                        'age' => $user_age
                    ];
                }

                if( $user_age < $min_max_age['min']['age'] ) {
                    $min_max_age['min'] = [
                        'email'  => $user['email'],
                        'age' => $user_age
                    ];
                }

            }
            $average_age = ceil(array_sum($user_ages)/count($user_ages));
            return array(
                'avg_age'   => $average_age,
                'youngest_user' => $min_max_age['min']['email'],
                'oldest_user'   => $min_max_age['max']['email']
            );
        }
    }


}