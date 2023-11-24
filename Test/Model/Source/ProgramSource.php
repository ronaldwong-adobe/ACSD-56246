<?php

namespace Adobe\Test\Model\Source;

class ProgramSource extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['value' => 'choice', 'label' => __('Choice')],
            ['value' => 'sunscape', 'label' => __('Sunscape')],
            ['value' => 'safetyshield', 'label' => __('Safetyshield')]
        ];
        return $this->_options;
    }
}
