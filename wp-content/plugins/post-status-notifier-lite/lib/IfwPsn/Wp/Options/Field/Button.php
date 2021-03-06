<?php
/**
 * ifeelweb.de WordPress Plugin Framework
 * For more information see http://www.ifeelweb.de/wp-plugin-framework
 *
 * Options button
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: Button.php 1850577 2018-03-31 19:25:01Z worschtebrot $
 */
require_once dirname(__FILE__) . '/../Field.php';

class IfwPsn_Wp_Options_Field_Button extends IfwPsn_Wp_Options_Field
{
    public function render(array $params)
    {
        /**
         * @var IfwPsn_Wp_Options
         */
        $options = $params[0];

        $id = $options->getOptionRealId($this->_id);
        $name = $options->getPageId() . '['. $id .']';

        $format = '<a class="button button-primary" href="%s" id="%s">%s</a>';
        $href = $this->_params['href'];
        $text = $this->_params['text'];

        if (isset($this->_params['id'])) {
            $id = $this->_params['id'];
        } else {
            $id = $name;
        }

        $output = $this->_getOutputStart($id);
        $output .= sprintf($format, $href, $id, $text);

        if (!empty($this->_params['error'])) {
            $output .= '<br><p class="error"> '  . $this->_params['error'] . '</p>';
        }
        if (!empty($this->_description)) {
            $output .= '<br><p class="description"> '  . $this->_description . '</p>';
        }

        $output .= $this->_getOutputEnd();
        echo $output;
    }
}
