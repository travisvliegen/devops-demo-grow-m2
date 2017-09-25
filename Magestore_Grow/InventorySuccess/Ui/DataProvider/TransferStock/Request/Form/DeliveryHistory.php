<?php
/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magestore\InventorySuccess\Ui\DataProvider\TransferStock\Request\Form;
use Magestore\InventorySuccess\Model\ResourceModel\TransferStock\TransferActivity\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\UrlInterface;

use Magestore\InventorySuccess\Model\TransferStock\TransferActivityFactory;


class DeliveryHistory extends AbstractDataProvider
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    protected $_transferActivityFactory;

    /** @var  \Magestore\InventorySuccess\Model\Locator\LocatorFactory $_locatorFactory */
    protected $_locatorFactory;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;
    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        UrlInterface $urlBuilder,
        TransferActivityFactory $transferActivityFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magestore\InventorySuccess\Model\Locator\LocatorFactory $locatorFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->urlBuilder = $urlBuilder;
        $this->_transferActivityFactory = $transferActivityFactory;
        $this->_request = $request;
        $this->_locatorFactory = $locatorFactory;

        $this->prepareCollection($collectionFactory);
    }

    public function prepareCollection($collectionFactory)
    {
        /** @var \Magestore\InventorySuccess\Model\Locator\Locator $locator */
        $locator = $this->_locatorFactory->create();
        $collection = $collectionFactory->create();
        $transferstock_id = $locator->getCurrentTransferstockId();

        if($transferstock_id){
            $collection->addFieldToFilter("activity_type", "delivery");
            $collection->addFieldToFilter("transferstock_id", $transferstock_id);
        }

        $this->collection = $collection;
    }
}