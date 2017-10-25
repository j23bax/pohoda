<?php
namespace Rshop\Synchronization\Pohoda\Type;

use Rshop\Synchronization\Pohoda\Agenda;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinksType extends Agenda
{
    /**
     * All elements
     *
     * @var array
     */
    protected $_elements = ['link'];

    /**
     * Configure options for options resolver
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver
     */
    protected function _configureOptions(OptionsResolver $resolver)
    {
        // available options
        $resolver->setDefined($this->_elements);
    }

    public function __construct($data, $ico, $resolveOptions = true)
    {
        if (isset($data['link'])) {
            $data['link'] = new LinkElementType($data['link'], $ico, $resolveOptions);
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
        $xml = $this->_createXML()->addChild('inv:links', null, $this->_namespace('inv'));

        $this->_addElements($xml, $this->_elements, 'typ');

        return $xml;
    }
}
