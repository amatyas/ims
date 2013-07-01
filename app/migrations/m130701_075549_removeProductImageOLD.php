<?php

class m130701_075549_removeProductImageOLD extends EDbMigration {

    public function up() {
        $this->dropTable('inv_product_image');
    }

    public function down() {
        echo "m130701_075549_removeProductImageOLD does not support migration down.\n";
        return false;
    }

    /*
      // Use safeUp/safeDown to do migration with transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}