<?php

namespace Plugin\Gift\Calc;

use Eccube\Application;
use Eccube\Entity\Order;
use Eccube\Service\Calculator\OrderDetailCollection;
use Eccube\Service\Calculator\Strategy\CalculateStrategyInterface;

class GiftWrappingStrategy implements CalculateStrategyInterface
{
    protected $Order;
    protected $app;

    public function execute(OrderDetailCollection $OrderDetails)
    {

        $Gift = $this->app['plugin.gift.repository.gift']->findBy(['order_id' => $this->Order->getId()]);
        // GiftWrappingが有効なときは明細に追加
        if ($Gift->isEnabled()) {
            $OrderDetail = new OrderDetail();
            $OrderDetail->setProductName('ギフトラッピング');
            $OrderDetail->setPrice(500);

            // 初回集計時と再集計時で処理を分けないといけない
            $OrderDetails[] = $OrderDetail;
        }
    }

    public function setApplication(Application $app)
    {
        $this->app = $app;

        return $this;
    }

    public function setOrder(Order $Order)
    {
        $this->Order = $Order;

        return $this;
    }
}