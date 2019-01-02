<?php
/**
 * Created By Shaymaa at 02/01/19 21:04.
 */

namespace MageArab\OrderItems\Controller\Adminhtml\Index;


class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $_orderItemFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context                     $context,
        \Magento\Framework\View\Result\PageFactory              $resultPageFactory,
        \Magento\Sales\Model\Order\ItemFactory                  $itemFactory

    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_orderItemFactory=$itemFactory;


    }
    public function execute(){
        $resultPage = $this->resultPageFactory->create();
        $resultRedirect = $this->resultRedirectFactory->create();
        $flag=true;
        if($orderId=$this->getRequest()->getParam('order_id')) {
            $items = json_decode($this->getRequest()->getParam('updated-items'));
            //var_dump($items);
            //die();
            if(empty($items)){
                $this->messageManager->addErrorMessage(__('You do not any item'));
                return $resultRedirect->setPath('sales/order/view', ['order_id' => $orderId]);

            }
            foreach ($items as $item){
                $item=json_decode(json_encode($item),true);
                $itemId=$item['itemId'];
                $orderItem=$this->_orderItemFactory->create()->load($itemId);
                $itemData=json_decode(json_encode($item['data']),true);
                foreach ($itemData as $row){
                    $orderItem->setData($row['key'],$row['value']);
                }
                try{
                    $orderItem->save();
                }catch (Exception $exception){
                    $flag=false;
                    $this->messageManager->addErrorMessage(__('Error while update item '.$itemId.'.'));

                }
            }

            if($flag){
                $this->messageManager->addSuccessMessage(__('Order Items successfully updated .'));
                return $resultRedirect->setPath('sales/order/view', ['order_id' => $orderId]);
            }
        }else{
            $this->messageManager->addErrorMessage(__('Error While get Order Id.'));
            return $resultRedirect->setPath('sales/order/view', ['order_id' => $orderId]);
        }
        return $resultPage;
	}
}

?>