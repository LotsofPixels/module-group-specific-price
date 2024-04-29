<?php
declare(strict_types=1);

namespace Lotsofpixels\GroupSpecificPrice\Plugin;

use Magento\Customer\Model\Session;



/**
 * class for changing product price
 */
class Product
{
    /**
     *
     */
    const CUSTOMERGROUP = 2;
    /**
     *
     */

    const KZPRICE = 'wholeprice';
    /**
     * @var Session
     */
    protected Session $customersession;



    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param $result
     * @return int
     */
    public function __construct(
        Session $customerSession,

    ){
        $this->customersession = $customerSession;


    }


    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param $result
     * @return mixed|null
     */
    public function afterGetPrice(
        \Magento\Catalog\Model\Product $subject,
                                       $result
    ) {
        $customerGroup=$this->customersession->getCustomer()->getGroupId();
        if($customerGroup == self::CUSTOMERGROUP){
            if($subject->getData(self::KZPRICE)) { return $subject->getData(self::KZPRICE); }
            else {return $result;}

        }
        return $result;
    }
}
