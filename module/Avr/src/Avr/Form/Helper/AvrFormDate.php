<?php
namespace Avr\Form\Helper;

use Zend\Form\ElementInterface;

class AvrFormDate extends \Zend\Form\View\Helper\FormInput
{

    /**
     * Determine input type to use
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected function getType(ElementInterface $element)
    {
        $value = $element->getValue();
        
        if ($value instanceof \DateTime) {
            $element->setValue(date('d/m/Y', $value->getTimestamp()));
        }
        
        return 'text';
    }
}
