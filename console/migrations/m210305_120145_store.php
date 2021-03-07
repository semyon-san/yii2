<?php

use yii\db\Migration;

/**
 * Class m210305_120145_store
 */
class m210305_120145_store extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210305_120145_store cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
        $this->createTable('{{%store}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->unique()->notNull(), // unique?
            'created_at' => $this->dateTime()->notNull()
        ], $tableOptions);
    }
    public function down()
    {
        echo "m210305_120145_store cannot be reverted.\n";
		$this->dropTable('{{%store}}');
        return false;
    }
}
