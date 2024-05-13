<?php

declare(strict_types=1);

namespace Lotsofpixels\GroupSpecificPrice\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

/**
 *
 */
class CustomPrice implements ObserverInterface
{
    /**
     * @throws \Zend_Log_Exception
     */
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $item = $observer->getEvent()->getData('quote_item');
        $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
        $price = $item ['price'];
        $item->setCustomPrice($price);
        $item->setOriginalCustomPrice($price);
        $item->getProduct()->setIsSuperMode(true);
    }

}