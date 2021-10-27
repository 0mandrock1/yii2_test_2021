<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group}}`.
 */
class m211026_144225_create_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('group', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'parent_id' => $this->integer()->notNull(),
        ]);

        // Create multiple nested array of seeding groups
        $groups = array();
        $root = [
            'name'      => "Root",
            'parent_id' => 0
        ];
        array_push($groups,$root);
        for($i=1;$i<=3;$i++){
            $i_array = [
                "name"      => "Group $i",
                "parent_id" => 1
            ];
            array_push($groups,$i_array);
            $found = array_filter($groups,function ($v) use ($i){
                return $v['name'] == "Group $i";
            }, ARRAY_FILTER_USE_BOTH);
            $j_parent = array_key_first($found)+1;
            for($j=1;$j<=3;$j++){
                $j_array = [
                    "name"      => "Group $i.$j",
                    "parent_id" => $j_parent,
                ];
                array_push($groups,$j_array);
                $found = array_filter($groups,function ($v) use ($i,$j){
                    return $v['name'] == "Group $i.$j";
                }, ARRAY_FILTER_USE_BOTH);
                $y_parent = array_key_first($found)+1;
                for ($y=1;$y<=3;$y++){
                    $y_array = [
                        "name"      => "Group $i.$j.$y",
                        "parent_id" => $y_parent
                    ];
                    array_push($groups,$y_array);
                }
            }
        }

        // Seed table
        foreach ($groups as $group) {
            $this->insert('group',$group);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('group');
    }
}
