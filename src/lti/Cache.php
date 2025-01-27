<?php
namespace IMSGlobal\LTI;

class Cache {

    private $cache;

    public function get_launch_data($key) {
        $this->load_cache();
        return $this->cache[$key];
    }

    public function cache_launch_data($key, $jwt_body) {
        $this->cache[$key] = $jwt_body;
        $this->save_cache();
        return $this;
    }

    public function cache_nonce($nonce) {
        $this->cache['nonce'][$nonce] = true;
        $this->save_cache();
        return $this;
    }

    public function check_nonce($nonce) {
        $this->load_cache();
        if (!isset($this->cache['nonce'][$nonce])) {
            return false;
        }
        return true;
    }

    private function load_cache() {
        $this->cache = $_SESSION['lti_cache'];
    }

    private function save_cache() {
        $_SESSION['lti_cache'] = $this->cache;
    }
}
?>