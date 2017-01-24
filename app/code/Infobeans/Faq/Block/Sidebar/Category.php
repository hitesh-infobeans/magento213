<?php
 

namespace Infobeans\Faq\Block\Sidebar; 

/**
 * Faq sidebar categories block
 */
class Category extends \Magento\Framework\View\Element\Template
{
    protected $_categoryCollection;
    
     public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Infobeans\Faq\Model\ResourceModel\Category\Collection $categoryCollection,
        array $data = []
    ) {
        
        parent::__construct($context, $data);
        $this->_categoryCollection = $categoryCollection;
    }
    
    
    public function getCategories()
    { 
        $k = 'categories';
        if (!$this->hasData($k)) {
            $array = $this->_categoryCollection 
                ->setOrder('sort_order','asc');  
            $this->setData($k, $array);
        }

        return $this->getData($k);
    }
    
    
}
