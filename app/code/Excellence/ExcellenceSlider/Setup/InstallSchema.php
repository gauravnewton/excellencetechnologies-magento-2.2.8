<?php
/**
 * Copyright © 2015 Excellence. All rights reserved.
 */

namespace Excellence\ExcellenceSlider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
   public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
	
        $installer = $setup;

        $installer->startSetup();

		/**
         * Create table 'excellenceslider_slider'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('excellenceslider_slider')
        )
		->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'excellenceslider_slider'
        )
		->addColumn(
            'path',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'path'
        )
		->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => false],
            'status'
        )		
        ->setComment(
            'Excellence ExcellenceSlider excellenceslider_slider'
        );
		
		$installer->getConnection()->createTable($table);
        
        $installer->endSetup();

    }
}
