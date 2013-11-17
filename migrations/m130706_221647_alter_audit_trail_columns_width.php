<?php
class m130706_221647_alter_audit_trail_columns_width extends CDbMigration {

	public function up() {
		if (!isset(Yii::app()->getDb()->tablePrefix)) {
			Yii::app()->getDb()->tablePrefix = '';
		};

        Yii::import('audittrail.models.AuditTrail');
        $table = AuditTrail::model()->tableName();
        
		$this->alterColumn($table, 'field', 'VARCHAR(50)');
		$this->alterColumn($table, 'model', 'VARCHAR(50)');
	}

	public function down() {
        
        Yii::import('audittrail.models.AuditTrail');
        $table = AuditTrail::model()->tableName();
        
		$this->alterColumn($table, 'field', 'VARCHAR(30)');
		$this->alterColumn($table, 'model', 'VARCHAR(30)');
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