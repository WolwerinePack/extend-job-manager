<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    IfwPsn_Vendor_Zend_Filter
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Compress.php 1312332 2015-12-19 13:29:57Z worschtebrot $
 */

/**
 * @see IfwPsn_Vendor_Zend_Filter_Interface
 */
require_once IFW_PSN_LIB_ROOT . 'IfwPsn/Vendor/Zend/Filter/Interface.php';

/**
 * Compresses a given string
 *
 * @category   Zend
 * @package    IfwPsn_Vendor_Zend_Filter
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class IfwPsn_Vendor_Zend_Filter_Compress implements IfwPsn_Vendor_Zend_Filter_Interface
{
    /**
     * Compression adapter
     */
    protected $_adapter = 'Gz';

    /**
     * Compression adapter constructor options
     */
    protected $_adapterOptions = array();

    /**
     * Class constructor
     *
     * @param string|array $options (Optional) Options to set
     */
    public function __construct($options = null)
    {
        if ($options instanceof IfwPsn_Vendor_Zend_Config) {
            $options = $options->toArray();
        }
        if (is_string($options)) {
            $this->setAdapter($options);
        } elseif ($options instanceof IfwPsn_Vendor_Zend_Filter_Compress_CompressInterface) {
            $this->setAdapter($options);
        } elseif (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set filter setate
     *
     * @param  array $options
     * @return IfwPsn_Vendor_Zend_Filter_Compress
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if ($key == 'options') {
                $key = 'adapterOptions';
            }
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * Returns the current adapter, instantiating it if necessary
     *
     * @return string
     */
    public function getAdapter()
    {
        if ($this->_adapter instanceof IfwPsn_Vendor_Zend_Filter_Compress_CompressInterface) {
            return $this->_adapter;
        }

        $adapter = $this->_adapter;
        $options = $this->getAdapterOptions();
        if (!class_exists($adapter)) {
            require_once IFW_PSN_LIB_ROOT . 'IfwPsn/Zend/Loader.php';
            if (IfwPsn_Zend_Loader::isReadable('IfwPsn/Vendor/Zend/Filter/Compress/' . ucfirst($adapter) . '.php')) {
                $adapter = 'IfwPsn_Vendor_Zend_Filter_Compress_' . ucfirst($adapter);
            }
            IfwPsn_Zend_Loader::loadClass($adapter);
        }

        $this->_adapter = new $adapter($options);
        if (!$this->_adapter instanceof IfwPsn_Vendor_Zend_Filter_Compress_CompressInterface) {
            require_once IFW_PSN_LIB_ROOT . 'IfwPsn/Vendor/Zend/Filter/Exception.php';
            throw new IfwPsn_Vendor_Zend_Filter_Exception("Compression adapter '" . $adapter . "' does not implement IfwPsn_Vendor_Zend_Filter_Compress_CompressInterface");
        }
        return $this->_adapter;
    }

    /**
     * Retrieve adapter name
     *
     * @return string
     */
    public function getAdapterName()
    {
        return $this->getAdapter()->toString();
    }

    /**
     * Sets compression adapter
     *
     * @param  string|IfwPsn_Vendor_Zend_Filter_Compress_CompressInterface $adapter Adapter to use
     * @return IfwPsn_Vendor_Zend_Filter_Compress
     */
    public function setAdapter($adapter)
    {
        if ($adapter instanceof IfwPsn_Vendor_Zend_Filter_Compress_CompressInterface) {
            $this->_adapter = $adapter;
            return $this;
        }
        if (!is_string($adapter)) {
            require_once IFW_PSN_LIB_ROOT . 'IfwPsn/Vendor/Zend/Filter/Exception.php';
            throw new IfwPsn_Vendor_Zend_Filter_Exception('Invalid adapter provided; must be string or instance of IfwPsn_Vendor_Zend_Filter_Compress_CompressInterface');
        }
        $this->_adapter = $adapter;

        return $this;
    }

    /**
     * Retrieve adapter options
     *
     * @return array
     */
    public function getAdapterOptions()
    {
        return $this->_adapterOptions;
    }

    /**
     * Set adapter options
     *
     * @param  array $options
     * @return void
     */
    public function setAdapterOptions(array $options)
    {
        $this->_adapterOptions = $options;
        return $this;
    }

    /**
     * Calls adapter methods
     *
     * @param string       $method  Method to call
     * @param string|array $options Options for this method
     */
    public function __call($method, $options)
    {
        $adapter = $this->getAdapter();
        if (!method_exists($adapter, $method)) {
            require_once IFW_PSN_LIB_ROOT . 'IfwPsn/Vendor/Zend/Filter/Exception.php';
            throw new IfwPsn_Vendor_Zend_Filter_Exception("Unknown method '{$method}'");
        }

        return call_user_func_array(array($adapter, $method), $options);
    }

    /**
     * Defined by IfwPsn_Vendor_Zend_Filter_Interface
     *
     * Compresses the content $value with the defined settings
     *
     * @param  string $value Content to compress
     * @return string The compressed content
     */
    public function filter($value)
    {
        return $this->getAdapter()->compress($value);
    }
}
