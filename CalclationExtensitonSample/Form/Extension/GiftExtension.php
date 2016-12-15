<?php

namespace Plugin\Gift\Form\Extension;

use Doctrine\ORM\EntityManager;
use Eccube\Application;
use Eccube\Entity\Order;
use Eccube\Entity\OrderDetail;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

class GiftExtension extends AbstractTypeExtension
{
    /**
     * @var Application
     */
    protected $app;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'gift',
            'choice',
            [
                // entityの継承がほしい
                'mapped' => false,
                'label' => 'ギフトラッピングを希望する(+500円)',
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    1 => '希望する',
                    2 => '希望しない',
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ]
        );

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                // ここではOrderと1:1のエンティティのデータ登録のみを行い集計処理はStrategyで実行する

                /** @var Order $Order */
                $Order = $event->getData();
                $Gift = $this->app['plugin.gift.repository.gift']->findBy(['order_id' => $Order->getId()]);
                if (!$Gift) {
                    $Gift = new Gift();
                    $Gift->setOrderId($Order->getId());
                    $this->app['orm.em']->persist($Gift);
                }

                $form = $event->getForm();
                $giftEnabled = $form['gift']->getData();
                $Gift->setEnabled($giftEnabled === 1);
            }
        );
    }

    public function getExtendedType()
    {
        return '_shopping_order';
    }
}
