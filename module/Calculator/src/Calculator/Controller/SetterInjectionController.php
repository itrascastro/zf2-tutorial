<?php
/**
 * xenFramework (http://xenframework.com/)
 *
 * This file is part of the xenframework package.
 *
 * (c) Ismael Trascastro <itrascastro@xenframework.com>
 *
 * @link        http://github.com/xenframework for the canonical source repository
 * @copyright   Copyright (c) xenFramework. (http://xenframework.com)
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Calculator\Controller;


use Calculator\Model\CalculatorModel;
use Calculator\Controller\Interfaces\CalculatorModelAwareInterface;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class SetterInjectionController
 *
 * Testing setter injection using initializers
 */
class SetterInjectionController extends AbstractActionController implements CalculatorModelAwareInterface
{
    /**
     * @var CalculatorModel
     */
    private $_model;

    public function setModel(CalculatorModel $model)
    {
        $this->_model = $model;
    }

    /**
     * indexControllerAction
     *
     * Testing the model
     *
     */
    public function indexAction()
    {
        $this->_model->setOp1(4);
        $this->_model->setOp2(2);
        $this->_model->multiply();

        return array('result' => $this->_model->getResult());
    }
}