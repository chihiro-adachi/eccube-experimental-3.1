<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @Eccube\Entity\Extend('Product')
 */
trait PriceTrait {

    /**
     * @Column(type="integer")
     */
    public $price;
}