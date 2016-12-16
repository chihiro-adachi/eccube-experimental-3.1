<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @Eccube\Entity\Extend('Product')
 */
trait TaxTrait {

    /**
     * @Column(type="integer")
     */
    public $tax;
}