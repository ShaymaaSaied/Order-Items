<?php

/**
 * Created by PhpStorm.
 * User: Shaymaa
 * Date: 30/12/2018
 * Time: 13:12
 */

namespace MageArab\OrderItems\Block\Adminhtml\Order\View\Items;


class SaveButton extends \Magento\Backend\Block\Template {

    protected $_orderId;
    protected $_uiBuilder;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\UrlInterface                 $urlBuilder,
        array $data = []
    ){
        $this->_uiBuilder=$urlBuilder;

        parent::__construct($context, $data);
    }
    public function getSaveUrl(){

        return $this->_uiBuilder->getUrl('orderitems/index/index',['order_id' => $this->_orderId]);
    }
    protected function _construct()
    {
        $this->_orderId=$this->getRequest()->getParam('order_id');
    }

}