<?php

use yii\db\Migration;

/**
 * Class m210305_120138_device
 */
class m210305_120138_device extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
        $this->createTable('{{%device}}', [
            'id' => $this->primaryKey(),
            'id_store' => $this->integer()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull()
        ], $tableOptions);
		
        $this->createIndex(
            'idx-device-id_store',
            'device',
            'id_store'
        );
		
        $this->addForeignKey(
            'fk-device-id_store',
            'device',
            'id_store',
            'store',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210305_120138_device cannot be reverted.\n";
		
        $this->dropForeignKey(
            'fk-device-id_store',
            'device'
        );
		
        $this->dropIndex(
            'idx-device-id_store',
            'device'
        );
		
		$this->dropTable('{{%device}}');
        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    /*public function up()
    {
    }

    public function down()
    {
    }*/
}
