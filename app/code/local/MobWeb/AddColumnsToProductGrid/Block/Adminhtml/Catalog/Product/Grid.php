<?php
class MobWeb_AddColumnsToProductGrid_Block_Adminhtml_Catalog_Product_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid {
    public function setCollection($collection)
    {
        $store = $this->_getStore();

        if ($store->getId() && !isset($this->_joinAttributes['brand'])) {
            $collection->joinAttribute(
                'brand',
                'catalog_product/brand',
                'entity_id',
                null,
                'left',
                $store->getId()
            );
        }
        else {
            $collection->addAttributeToSelect('brand');
        }

        parent::setCollection($collection);
    }

    protected function _prepareColumns()
    {
        $store = $this->_getStore();
        $this->addColumnAfter('brand',
            array(
                'header'=> Mage::helper('catalog')->__('Brand'),
                'index' => 'brand',
            ),
            'price'
         );

        return parent::_prepareColumns();
    }
}