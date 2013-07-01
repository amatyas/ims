<?php

class m130701_055815_removeSpecialPriceDates extends EDbMigration {

    public function up() {
        $this->dropColumn('inv_product', 'special_price_start');
        $this->dropColumn('inv_product', 'special_price_end');
    }

    public function down() {
        echo "m130701_055815_removeSpecialPriceDates does not support migration down.\n";
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