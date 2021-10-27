<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m211026_135019_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'email' => $this->string(255)->notNull()->unique(),
            'birth_date' => $this->datetime()->notNull(),
            'group_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'email_UNIQUE',
            'user',
            'email'
        );

        // Use Faker to seed table
        $faker = Faker\Factory::create();

        for ($i=0;$i<=150;$i++) {
            $this->insert('user',[
               'email'=>$faker->email,
               'birth_date'=> $faker->dateTimeBetween('-50 years','-20 years')->format('Y-m-d H:i:s'),
               'group_id' => rand(1,39)
            ]);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('email_UNIQUE','user');
        $this->dropTable('user');
    }
}
