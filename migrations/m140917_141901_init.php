<?php
class m140917_141901_init extends CDbMigration {

	public function up() {
		if (!isset(Yii::app()->getDb()->tablePrefix)) {
			Yii::app()->getDb()->tablePrefix = '';
		};

        Yii::import('audittrail.models.AuditTrail');
        $table = AuditTrail::model()->tableName();
        
        $sql = "
            CREATE TABLE IF NOT EXISTS `{$table}` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `old_value` text COLLATE utf8_unicode_ci,
            `new_value` text COLLATE utf8_unicode_ci,
            `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `field` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
            `stamp` datetime NOT NULL,
            `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
            `model_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            PRIMARY KEY (`id`),
            KEY `model` (`model`(4),`model_id`(4))
          ) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
                
                   ";
         $this->execute($sql);
        
	}

	public function down() {
        
		if (!isset(Yii::app()->getDb()->tablePrefix)) {
			Yii::app()->getDb()->tablePrefix = '';
		};

        Yii::import('audittrail.models.AuditTrail');
        $table = AuditTrail::model()->tableName();
        
        $sql = "DROP TABLE `{$table}`";
        $this->execute($sql);
        
	}

	/**
	 * Transaction-safe migration up, be aware that MySQL has autocommit after every DDL statement.
	 * Uses $this->up to not duplicate code.
	 */
	public function safeUp() {
		$this->up();
	}
	
	/**
	 * Transaction-safe migration down, be aware that MySQL has autocommit after every DDL statement.
	 * Uses $this->down to not duplicate code.
	 */
	public function safeDown() {
		$this->down();
	}
}
?>