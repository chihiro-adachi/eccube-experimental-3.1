<?php 
/**
 * @Entity
 * @Table(name="products")
 */
class ProductProxy
{

    use PriceTrait, TaxTrait;

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    public $id = null;

    /**
     * @Column(type="string")
     */
    public $name = null;


}
