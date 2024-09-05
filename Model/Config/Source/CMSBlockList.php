<?php

namespace Epos\CustomProductField\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class CMSBlockList extends AbstractSource
{
    protected $blockRepositoryInterface;
    protected $searchCriteriaBuilder;

    public function __construct(
        BlockRepositoryInterface $blockRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->blockRepositoryInterface = $blockRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Retrieve options array
     *
     * @return array
     */
    public function getOptionArray()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $blocks = $this->blockRepositoryInterface->getList($searchCriteria)->getItems();
        $options = [];
        foreach ($blocks as $block) {
            $options[$block->getId()] = $block->getTitle();
        }
        return $options;
    }

    /**
     * Retrieve all options as an array
     *
     * @return array
     */
    public function getAllOptions()
    {
        $res = $this->getOptions();
        array_unshift($res, ['value' => '', 'label' => __('Please Select')]);
        return $res;
    }

    /**
     * Retrieve options formatted for select fields
     *
     * @return array
     */
    public function getOptions()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }

    /**
     * Retrieve options for select fields
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->getOptions();
    }
}
