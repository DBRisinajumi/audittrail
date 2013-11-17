<?php
class m130706_204540_alter_audit_trail_table extends CDbMigration {

	public function up() {
		if (!isset(Yii::app()->getDb()->tablePrefix)) {
			Yii::app()->getDb()->tablePrefix = '';
		};
	
        Yii::import('audittrail.models.AuditTrail');
        $table = AuditTrail::model()->tableName();

        
		// drop indexes before changing columns types
		$this->dropIndex('idx_audit_trail_user_id', $table);
		$this->dropIndex('idx_audit_trail_model_id', $table);
		
		$this->renameColumn($table, 'id', 'id_trail');
		$this->alterColumn($table, 'action', 'VARCHAR(10) NOT NULL');
		$this->alterColumn($table, 'model', 'VARCHAR(30) NOT NULL');
		$this->alterColumn($table, 'field', 'VARCHAR(30)');
		$this->alterColumn($table, 'stamp', 'TIMESTAMP NOT NULL');
		$this->alterColumn($table, 'user_id', 'VARCHAR(20) NOT NULL');
		$this->alterColumn($table, 'model_id', 'VARCHAR(20) NOT NULL');
		
		// recreate indexes
		$this->createIndex('idx_audit_trail_user_id', $table, 'user_id');
		$this->createIndex('idx_audit_trail_model_id', $table, 'model_id');
	}

	public function down() {

        Yii::import('audittrail.models.AuditTrail');
        $table = AuditTrail::model()->tableName();

        
		$this->renameColumn($table, 'id_trail', 'id');
		$this->alterColumn($table, 'action', 'string NOT NULL');
		$this->alterColumn($table, 'model', 'string NOT NULL');
		$this->alterColumn($table, 'field', 'string');
		$this->alterColumn($table, 'stamp', 'datetime NOT NULL');
		$this->alterColumn($table, 'user_id', 'string');
		$this->alterColumn($table, 'model_id', 'string NOT NULL');
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