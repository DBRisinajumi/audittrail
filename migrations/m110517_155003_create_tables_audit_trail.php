<?php

class m110517_155003_create_tables_audit_trail extends CDbMigration
{

	/**
	 * Creates initial version of the audit trail table
	 */
	public function up()
	{

		//Create our first version of the audittrail table	
		//Please note that this matches the original creation of the 
		//table from version 1 of the extension. Other migrations will
		//upgrade it from here if we ever need to. This was done so
		//that older versions can still use migrate functionality to upgrade.
		$this->createTable( 'audit_trail_page',
			array(
				'id' => 'pk',
				'action' => 'string NOT NULL',
				'model' => 'string NOT NULL',
				'stamp' => 'datetime NOT NULL',
				'user_id' => 'string',
				'model_id' => 'string NOT NULL',
			)
		);
                
                $this->createTable( 'audit_trail_record',
			array(
				'id' => 'pk',
                                'page_id' => 'int NOT NULL',
				'old_value' => 'text',
				'new_value' => 'text',
				'field' => 'string',
			)
		);

		//Index these bad boys for speedy lookups
		$this->createIndex( 'idx_audit_trail_user_id', 'audit_trail_page', 'user_id');
		$this->createIndex( 'idx_audit_trail_model_id', 'audit_trail_page', 'model_id');
		$this->createIndex( 'idx_audit_trail_model', 'audit_trail_page', 'model');
		/* http://stackoverflow.com/a/1827099/383478
		$this->createIndex( 'idx_audit_trail_old_value', 'tbl_audit_trail', 'old_value');
		$this->createIndex( 'idx_audit_trail_new_value', 'tbl_audit_trail', 'new_value');
		*/
                
                //Foreign keys
                $this->addForeignKey('fk_record_to_page', 'audit_trail_record', 'page_id', 'audit_trail_page', 'id','CASCADE','CASCADE');
	}

	/**
	 * Drops the audit trail table
	 */
	public function down()
	{
		$this->dropTable( 'audit_trail_page' );
                $this->dropTable( 'audit_trail_record' );
	}

	/**
	 * Creates initial version of the audit trail table in a transaction-safe way.
	 * Uses $this->up to not duplicate code.
	 */
	public function safeUp()
	{
		$this->up();
	}

	/**
	 * Drops the audit trail table in a transaction-safe way.
	 * Uses $this->down to not duplicate code.
	 */
	public function safeDown()
	{
		$this->down();
	}
}
