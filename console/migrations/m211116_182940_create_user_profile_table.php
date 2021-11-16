<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_profile}}`.
 */
class m211116_182940_create_user_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_profile}}', [
            'user_id' => $this->integer()->notNull(),
            'surname' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'user_user_profile',  // это "условное имя" ключа
            'user_profile', // это название текущей таблицы
            'user_id', // это имя поля в текущей таблице, которое будет ключом
            'user', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_profile}}');
    }
}
