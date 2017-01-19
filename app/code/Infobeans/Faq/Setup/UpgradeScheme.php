<?php 
namespace Infobeans\Faq\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrade DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
        
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
        
                $table = $installer->getConnection()
                    ->newTable($installer->getTable('infobeans_faq_category'))
                    ->addColumn(
                        'category_id',
                        Table::TYPE_SMALLINT,
                        null,
                        ['identity' => true, 'nullable' => false, 'primary' => true],
                        'Category ID'
                    )
                    ->addColumn('category_name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Faq Category Name')
                    ->addColumn('sort_order', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '0'], 'Sort Order')
                    ->addColumn('is_active', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '1'], 'Is FAQ Active?')
                    ->addColumn('creation_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Creation Time')
                    ->addColumn('update_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Update Time')            
                    ->setComment('Infobeans FAQ Category');

                $installer->getConnection()->createTable($table);


                $installer->getConnection()->addColumn($setup->getTable('infobeans_faq'), 'category_id', [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, 
                        'nullable' => false,
                        'comment' => 'Category Id',
                    ]);

                $installer->endSetup();
        }
    }

}
