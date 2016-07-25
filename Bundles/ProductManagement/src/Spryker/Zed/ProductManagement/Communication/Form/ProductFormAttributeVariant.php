<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductManagement\Communication\Form;

use Spryker\Zed\Gui\Communication\Form\Type\Select2ComboBoxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ProductFormAttributeVariant extends ProductFormAttributeAbstract
{

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addValueField(FormBuilderInterface $builder, array $options = [])
    {
        $name = $builder->getName();
        $attributes = $options[self::OPTION_ATTRIBUTE];
        $config = $this->getValueFieldConfig($name, $attributes);

        $input = new Select2ComboBoxType();
        $config['multiple'] = true; //be able to select multiple values of super attributes;
        $config['attr']['style'] .= ' width: 250px';
        $config['choices'] = [];
        $config['attr']['class'] .= ' ajax';
        $config['attr']['tags'] = false; //don't allow undefined values

        $builder->add(self::FIELD_VALUE, $input, $config);

        $builder->get(self::FIELD_VALUE)->resetViewTransformers();

        /*$builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($input, $config) {
            $product = $event->getData();
            $v = $event->getForm()->get('value')->getData();
            $form = $event->getForm();

            $config['choices'] = [1 => 'Tamas', '2' => 'Atom'];
            $form->add(self::FIELD_VALUE, $input, $config);

            //sd($product, $v);
        });*/

        return $this;
    }

}
