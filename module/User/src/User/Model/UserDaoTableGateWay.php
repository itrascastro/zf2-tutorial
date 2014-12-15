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

namespace User\Model;


use User\Model\Interfaces\UserDaoInterface;
use Zend\Db\TableGateway\TableGateway;

class UserDaoTableGateWay implements UserDaoInterface
{
    /**
     * @var TableGateWay
     */
    private $_tableGateWay;

    function __construct(TableGateway $_tableGateway)
    {
        $this->_tableGateWay = $_tableGateway;
    }

    public function findAll()
    {
        return $this->_tableGateWay->select();
    }

    public function getById($id)
    {
        $rows = $this->_tableGateWay->select(['id' => $id]);

        return $rows->current();
    }

    public function save($data)
    {
        $this->_tableGateWay->insert($data);
    }

    public function delete($id)
    {
        $this->_tableGateWay->delete(['id' => $id]);
    }

    public function update($data)
    {
        $this->_tableGateWay->update($data, ['id' => $data['id']]);
    }
}