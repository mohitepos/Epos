<?php 

namespace Epos\CustomProductField\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ProductRepository;

class ProductDetails extends Template
{
    protected $_product;

    public function __construct(
        Template\Context $context,
        ProductRepository $productRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $productId = $this->getRequest()->getParam('id'); // Get product ID from the request
        $this->_product = $productRepository->getById($productId);
    }

    public function getProduct()
    {
        return $this->_product;
    }
}
