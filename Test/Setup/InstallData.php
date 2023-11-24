<?php


namespace Adobe\Test\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class InstallData implements InstallDataInterface
{

    private $customerSetupFactory;

    private $eavSetupFactory;

    /**
     * Constructor
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        //customer attribute
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'customer_program', [
            'type' => 'varchar',
            'label' => 'Program',
            'input' => 'multiselect',
            'source' => 'Adobe\Test\Model\Source\ProgramSource',
            'required' => false,
            'visible' => true,
            'position' => 333,
            'system' => false,
            'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend'
        ]);

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'customer_program')
            ->addData(['used_in_forms' => [
                'adminhtml_customer'
            ]
            ]);
        $attribute->save();
    }
}
