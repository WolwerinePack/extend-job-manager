<?php
/**
 * ifeelweb.de WordPress Plugin Framework
 * For more information see http://www.ifeelweb.de/wp-plugin-framework
 * 
 * String helper class
 *
 * @author    Timo Reith <timo@ifeelweb.de>
 * @copyright Copyright (c) ifeelweb.de
 * @version   $Id: String.php 1850577 2018-03-31 19:25:01Z worschtebrot $
 * @package   IfwPsn_Util
 */ 
class IfwPsn_Util_String
{
    const COMPRESSION_TYPE_NONE = 'none';
    const COMPRESSION_TYPE_GZ = 'gz';

    public static $compressionTypeUsed;

    /**
     * @param $string
     * @return string
     */
    public static function compress($string)
    {
        self::$compressionTypeUsed = self::COMPRESSION_TYPE_NONE;

        if (function_exists('gzcompress')) {
            self::$compressionTypeUsed = self::COMPRESSION_TYPE_GZ;
            $string = gzcompress($string, 9);
        }

        return $string;
    }

    /**
     * @param $string
     * @param null $forceCompressionType
     * @return string
     */
    public static function uncompress($string, $forceCompressionType = null)
    {
        if (function_exists('gzuncompress') && ($forceCompressionType === null || $forceCompressionType === self::COMPRESSION_TYPE_GZ)) {
            $uncompressedString = gzuncompress($string);
            if ($uncompressedString !== false) {
                $string = $uncompressedString;
            }
        }

        return $string;
    }
}
