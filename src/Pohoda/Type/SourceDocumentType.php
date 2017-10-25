<?php
namespace Rshop\Synchronization\Pohoda\Type;

use Rshop\Synchronization\Pohoda\Agenda;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SourceDocumentType extends Agenda
{
    /**
     * All elements
     *
     * @var array
     */
    protected $_elements = ['id', 'number'];

    /**
     * Configure options for options resolver
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver
     */
    protected function _configureOptions(OptionsResolver $resolver)
    {
        // available options
        $resolver->setDefined($this->_elements);

        $resolver->setNormalizer('id', $resolver->intNormalizer);
        $resolver->setNormalizer('number', $resolver->string32Normalizer);
    }

    /**
     * Get XML
     *
     * @return \SimpleXMLElement
     */
    public function getXML()
    {
        $xml = $this->_createXML()->addChild('typ:sourceDocument', null, $this->_namespace('typ'));

        $this->_addElements($xml, $this->_elements, 'typ');

        return $xml;
    }
}
