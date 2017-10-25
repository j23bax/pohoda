<?php
namespace Rshop\Synchronization\Pohoda\Type;

use Rshop\Synchronization\Pohoda\Agenda;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkElementType extends Agenda
{
    /**
     * All elements
     *
     * @var array
     */
    protected $_elements = ['sourceAgenda', 'sourceDocument'];

    /**
     * Configure options for options resolver
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver
     */
    protected function _configureOptions(OptionsResolver $resolver)
    {
        // available options
        $resolver->setDefined($this->_elements);

        // validate / format options
        $resolver->setDefault('sourceAgenda', 'receivedOrder');
        $resolver->setAllowedValues('sourceAgenda', ['receivedOrder']); // TODO: rozsirit
    }

    public function __construct($data, $ico, $resolveOptions = true)
    {
        if (isset($data['sourceDocument'])) {
            $data['sourceDocument'] = new SourceDocumentType($data['sourceDocument'], $ico, $resolveOptions);
        }

        parent::__construct($data, $ico, $resolveOptions);
    }

    /**
     * Get XML
     *
     * @return \SimpleXMLElement
     */
    public function getXML()
    {
        $xml = $this->_createXML()->addChild('typ:link', null, $this->_namespace('typ'));

        $this->_addElements($xml, $this->_elements, 'typ');

        return $xml;
    }
}
