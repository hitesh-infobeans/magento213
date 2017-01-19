<?php
namespace Infobeans\Faq\Controller\Ajax;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;
    
    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
    
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Faq Index, shows a list of faqs.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    
    public function execute()
    { 
       /* $layout = $this->_view->getLayout();
        $block = $layout->createBlock('Infobeans\Faq\Block\Faqlist');
        $this->getResponse()->appendBody($block->toHtml());
        */
        $resultPage = $this->resultPageFactory->create();

        $block = $resultPage->getLayout()
                ->createBlock('Infobeans\Faq\Block\Faqlist')
                ->setTemplate('Infobeans_Faq::ajaxlist.phtml')
                ->toHtml();
        $this->getResponse()->setBody($block); 
        
        
        
       /* $resultPage = $this->resultPageFactory ->create();
        $blockInstance = $resultPage->getLayout()->getBlock('faq.ajax');
         return $resultPage;*/
      //  return $blockInstance;
        
        
    }
}
