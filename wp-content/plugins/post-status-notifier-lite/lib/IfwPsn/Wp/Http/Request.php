<?php
/**
 * ifeelweb.de WordPress Plugin Framework
 * For more information see http://www.ifeelweb.de/wp-plugin-framework
 *
 *
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: Request.php 1850577 2018-03-31 19:25:01Z worschtebrot $
 */
class IfwPsn_Wp_Http_Request
{
    /**
     * @var IfwPsn_Wp_Plugin_Manager
     */
    protected $_pm;

    /**
     * @var string
     */
    protected $_url;

    /**
     * @var string
     */
    protected $_userAgent;

    /**
     * @var int
     */
    protected $_timeout;

    /**
     * @var bool
     */
    protected $_sslverify;

    /**
     * @var array
     */
    protected $_data = array();

    /**
     * @var string
     */
    protected $_sendMethod = 'post';



    /**
     * @param IfwPsn_Wp_Plugin_Manager $pm
     */
    public function __construct($pm = null)
    {
        if ($pm instanceof IfwPsn_Wp_Plugin_Manager) {
            $this->_pm = $pm;
        }

        $this->_init();
    }

    /**
     *
     */
    protected function _init()
    {
    }

    /**
     * @return IfwPsn_Wp_Http_Response
     */
    public function send()
    {
        $args = array();

        if ($this->getUserAgent() !== null) {
            $args['user-agent'] = $this->getUserAgent();
        }
        if ($this->getTimeout() !== null) {
            $args['timeout'] = $this->getTimeout();
        }
        if ($this->getSslverify() !== null) {
            $args['sslverify'] = $this->getSslverify();
        }

        if ($this->getSendMethod() == 'post') {

            $args['body'] = $this->getData();

            $this->_log('Sending POST request', array_merge($args, array('url' => $this->getUrl())));

            $response = wp_remote_post($this->getUrl(), $args);

        } elseif ($this->getSendMethod() == 'get') {

            $url = add_query_arg($this->getData(), $this->getUrl());
            $url = esc_url_raw($url);

            $this->_log('Sending GET request', array_merge($args, array('url' => $url)));

            $response = wp_remote_get($url, $args);
        }

        $this->_log('Request completed', array('response' => $response));

        if (isset($response)) {
            return new IfwPsn_Wp_Http_Response($response);
        }

        return null;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @param string $userAgent
     * @return $this
     */
    public function setUserAgent($userAgent)
    {
        $this->_userAgent = $userAgent;
        return $this;
    }

    /**
     * @return $this
     */
    public function setRandomUserAgent()
    {
        $this->_userAgent = self::getRandomUserAgent();
        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->_userAgent;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->_timeout;
    }

    /**
     * @param int $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->_timeout = $timeout;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getSslverify()
    {
        return $this->_sslverify;
    }

    /**
     * @param boolean $sslverify
     * @return $this
     */
    public function setSslverify($sslverify)
    {
        if (is_bool($sslverify)) {
            $this->_sslverify = $sslverify;
        }
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function addData($key, $value)
    {
        $this->_data[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * @param string $sendMethod
     * @return $this
     */
    public function setSendMethod($sendMethod)
    {
        if (in_array($sendMethod, array('get', 'post'))) {
            $this->_sendMethod = $sendMethod;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getSendMethod()
    {
        return $this->_sendMethod;
    }

    /**
     * @param $message
     * @param array $options
     */
    protected function _log($message, array $options)
    {
        if ($this->_pm instanceof IfwPsn_Wp_Plugin_Manager) {
            $this->_pm->log('http_request', $message, $options);
        }
    }

    /**
     * @return string
     */
    public static function getRandomUserAgent()
    {
        $agents = self::getUserAgents();

        return $agents[rand(0, count($agents)-1)];
    }

    /**
     * @return array
     */
    public static function getUserAgents()
    {
        return array(
            'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36',
            'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2224.3 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246',
            'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
            'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A',
            'Mozilla/5.0 (Linux; U; Android 4.0.3; ko-kr; LG-L160L Build/IML74K) AppleWebkit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
            'Mozilla/5.0 (Linux; U; Android 4.0.3; de-ch; HTC Sensation Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
            'Mozilla/5.0 (Linux; U; Android 2.3; en-us) AppleWebKit/999+ (KHTML, like Gecko) Safari/999.9',
            'Mozilla/5.0 (Linux; U; Android 2.3.5; zh-cn; HTC_IncredibleS_S710e Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
            'Mozilla/5.0 (Linux; U; Android 2.3.5; en-us; HTC Vision Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
            'Mozilla/5.0 (Linux; U; Android 2.3.3; zh-tw; HTC_Pyramid Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari',
            'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (S60; SymbOS; Opera Mobi/23.348; U; en) Presto/2.5.25 Version/10.54',
            'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (J2ME/23.377; U; en) Presto/2.5.25 Version/10.54',
            'Opera/9.80 (J2ME/MIDP; Opera Mini/9 (Compatible; MSIE:9.0; iPhone; BlackBerry9700; AppleWebKit/24.746; U; en) Presto/2.5.25 Version/10.54',
            'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko',
            'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
            'Mozilla/5.0 (compatible; MSIE 10.6; Windows NT 6.1; Trident/5.0; InfoPath.2; SLCC1; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET CLR 2.0.50727) 3gpp-gba UNTRUSTED/1.0',
            'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 7.0; InfoPath.3; .NET CLR 3.1.40767; Trident/6.0; en-IN)',
            'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)',
            'Mozilla/4.0 (Compatible; MSIE 8.0; Windows NT 5.2; Trident/6.0)',
            'Mozilla/4.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/5.0)',
            'Mozilla/5.0 (Linux; Android 4.0.4; Galaxy Nexus Build/IMM76B) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.133 Mobile Safari/535.19',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) CriOS/56.0.2924.75 Mobile/14E5239e Safari/602.1',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/600.7.12 (KHTML, like Gecko) Version/8.0.7 Safari/600.7.12',
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36',
            'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1',
            'Mozilla/5.0 (Linux; Android 4.4.3; KFTHWI Build/KTU84M) AppleWebKit/537.36 (KHTML, like Gecko) Silk/47.1.79 like Chrome/47.0.2526.80 Safari/537.36',
        );
    }
}
 