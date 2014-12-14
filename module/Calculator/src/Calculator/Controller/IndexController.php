<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Calculator\Controller;

use Calculator\Model\CalculatorModel;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    /**
     * @var CalculatorModel
     */
    private $_model;

    /**
     * @param CalculatorModel $_model
     *
     * This is an example of constructor injection
     * This controller has been registered in module.config.php at the controllers services as a factory one
     */
    public function __construct(CalculatorModel $_model)
    {
        $this->_model = $_model;
    }

    public function indexAction()
    {
        $this->layout()->setVariables(array('title' => 'Calculator Menu'));
        return array();
    }

    public function addAction()
    {
        $this->layout()->title = 'Add';
        return array();
    }

    public function doAddAction()
    {
        $this->layout()->title = 'doAdd';

        $this->_model->setOp1($this->params()->fromPost('op1'));
        $this->_model->setOp2($this->params()->fromPost('op2'));
        $this->_model->add();

        return array(
            'op1'       => $this->_model->getOp1(),
            'op2'       => $this->_model->getOp2(),
            'result'    => $this->_model->getResult()
        );

    }
}
