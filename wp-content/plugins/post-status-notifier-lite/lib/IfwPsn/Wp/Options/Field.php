<?php
/**
 * ifeelweb.de WordPress Plugin Framework
 * For more information see http://www.ifeelweb.de/wp-plugin-framework
 *
 * Options field
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: Field.php 1850577 2018-03-31 19:25:01Z worschtebrot $
 */
abstract class IfwPsn_Wp_Options_Field
{
    /**
     * @var string
     */
    protected $_id;

    /**
     * @var string
     */
    protected $_label;

    /**
     * @var string
     */
    protected $_description;

    /**
     * @var array
     */
    protected $_params;

    /**
     * @var null|string
     */
    protected $_pageId;


    /**
     * @param $id
     * @param $label
     * @param null $description
     * @param array $params
     */
    public function __construct($id, $label, $description = null, $params = array())
    {
        $this->_id = $id;
        $this->_label = $label;
        if (!empty($description)) {
            $this->_description = $description;
        }
        $this->_params = $params;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->_label = $label;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param null|string $pageId
     */
    public function setPageId($pageId)
    {
        $this->_pageId = $pageId;
    }

    /**
     * @return null|string
     */
    public function getPageId()
    {
        return $this->_pageId;
    }

    /**
     * @return null|string
     */
    public function hasPageId()
    {
        return !empty($this->_pageId);
    }

    /**
     * @return bool
     */
    public function hasSanitizer()
    {
        return isset($this->_params['sanitizer']);
    }

    /**
     * @return mixed
     */
    public function getSanitizer()
    {
        return isset($this->_params['sanitizer']) ? $this->_params['sanitizer'] : null;
    }

    /**
     * @param $id
     * @return string
     */
    protected function _getOutputStart($id)
    {
        return sprintf('<div id="%s">', $id . '_box');
    }

    /**
     * @param $id
     * @return string
     */
    protected function _getOutputEnd($id = null)
    {
        return '</div>';
    }

    /**
     * @param array $params
     * @return mixed
     */
    abstract public function render(array $params);
}
