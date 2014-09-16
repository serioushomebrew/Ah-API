<?php
/**
 * AlbertHeijn.php
 *
 * Created by: koen
 * Original: https://gist.github.com/ajslaghu/3c4dee228e4deba8018e
 * Date: 9/16/14
 */
class AlbertHeijn {

    private $key, $api_url;

    public function __construct($key) {
        $this->key = $key;
        $this->api_url = "https://frahmework.ah.nl/!ahpi";
    }

    public function getDeliveries($params = array()) {
        return $this->_get("leveringen.php", $params);
    }

    public function getArticleInfo($params = array()) {
        return $this->_get("artikelinfo.php", $params);
    }

    public function getMutations($params = array()) {
        return $this->_get("mutaties.php", $params);
    }

    public function getRecepies($params = array()) {
        return $this->_get("recepten.php", $params);
    }

    public function getTransactions($params = array()) {
        return $this->_get("transacties.php", $params);
    }

    public function getSales($params = array()) {
        return $this->_get("verkoop.php", $params);
    }

    public function getShops($params = array()) {
        return $this->_get("winkels.php", $params);
    }

    public function getBreadWarenty($params = array()){
        return $this->_get("broodgarantie.php", $params);
    }


    private function _get($path, $params) {
        $params['ahpikey'] = $this->key;
        $query_params = http_build_query($params);
        $url = $this->api_url . '/' . $path . '?' . $query_params;
        $html = file_get_contents($url);
        $json = json_decode($html);
        if ($json == NULL){
            echo $html;
            throw new Exception("Exception on url \t" . $url);
        }
        return $json;
    }
} 