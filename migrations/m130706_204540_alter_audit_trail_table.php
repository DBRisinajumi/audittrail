<?php
class m130706_204540_alter_audit_trail_table extends CDbMigration {

	public function up() {
		if (!isset(Yii::app()->getDb()->tablePrefix)) {
			Yii::app()->getDb()->tablePrefix = '';
		};
		
		// drop indexes before changing columns types
		$this->dropIndex('idx_audit_trail_user_id', '{{audit_trail}}');
		$this->dropIndex('idx_audit_trail_model_id', '{{audit_trail}}');
		
		$this->renameColumn('{{audit_trail}}', 'id', 'id_trail');
		$this->alterColumn('{{audit_trail}}', 'action', 'VARCHAR(10) NOT NULL');
		$this->alterColumn('{{audit_trail}}', 'model', 'VARCHAR(30) NOT NULL');
		$this->alterColumn('{{audit_trail}}', 'field', 'VARCHAR(30)');
		$this->alterColumn('{{audit_trail}}', 'stamp', 'TIMESTAMP NOT NULL');
		$this->alterColumn('{{audit_trail}}', 'user_id', 'VARCHAR(20) NOT NULL');
		$this->alterColumn('{{audit_trail}}', 'model_id', 'VARCHAR(20) NOT NULL');
		
		// recreate indexes
		$this->createIndex('idx_audit_trail_user_id', '{{audit_trail}}', 'user_id');
		$this->createIndex('idx_audit_trail_model_id', '{{audit_trail}}', 'model_id');
	}

	public function down() {
		$this->renameColumn('{{audit_trail}}', 'id_trail', 'id');
		$this->alterColumn('{{audit_trail}}', 'action', 'string NOT NULL');
		$this->alterColumn('{{audit_trail}}', 'model', 'string NOT NULL');
		$this->alterColumn('{{audit_trail}}', 'field', 'string');
		$this->alterColumn('{{audit_trail}}', 'stamp', 'datetime NOT NULL');
		$this->alterColumn('{{audit_trail}}', 'user_id', 'string');
		$this->alterColumn('{{audit_trail}}', 'model_id', 'string NOT NULL');
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