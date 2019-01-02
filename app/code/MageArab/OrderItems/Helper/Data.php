<?php
/**
 * Created By Shaymaa at 02/01/19 20:51.
 */

/**
 * Created By Shaymaa at 29/12/18 22:10.
 */

/**
 * Created by PhpStorm.
 * User: Shaymaa
 * Date: 29/12/2018
 * Time: 22:10
 */

namespace MageArab\OrderItems\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper{
    public function __construct(
        Context                                            $context
    )
    {

        parent::__construct($context);
    }

    public function getShippingStatusLabel($status){
        switch ($status){
            case 0:
                return __('Pending');
            case 1:
                return __('Warehouse Shipped');
            case 2:
                return __('Warehouse Received');
            case 3:
                return __('Local Warehouse Received');
            case 4:
                return __('Local Warehouse Shipped');
            default:
                return __('Pending');
        }
    }
}