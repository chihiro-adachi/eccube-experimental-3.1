<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="products")
 **/
class Product
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     **/
    public $id;

    /**
     * @Column(type="string")
     **/
    public $name;

}