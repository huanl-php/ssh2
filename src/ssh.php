<?php
/**
 *============================
 * author:Farmer
 * time:18-12-30 下午9:46
 * blog:blog.icodef.com
 * function:
 *============================
 */


namespace HuanL\SSH2;


class ssh {

    protected $ssh;

    protected $host;

    protected $port;

    public function __construct($host, $port) {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * 连接ssh服务器
     * @return bool
     */
    public function connect() {
        @$this->ssh = ssh2_connect($this->host, $this->port);
        if ($this->ssh) {
            return true;
        }
        return false;
    }

    /**
     * 通过密码登录
     * @param $user
     * @param $passwd
     * @return bool
     */
    public function login_passwd($user, $passwd) {
        return ssh2_auth_password($this->ssh, $user, $passwd);
    }

    /**
     * 通过秘钥登录
     * @param $user
     * @param $publicFile
     * @param $privateFile
     * @return bool
     */
    public function login_pubkey($user, $publicFile, $privateFile) {
        return @ssh2_auth_pubkey_file($this->ssh, $user, $publicFile, $privateFile);
    }

    /**
     * 断开连接
     * @return bool
     */
    public function disconnect() {
        return ssh2_disconnect($this->ssh);
    }

    /**
     * 创建一个交互式的shell
     * @param string $term_type
     * @param array $env
     * @param int $width
     * @param int $height
     * @param int $width_height_type
     * @return shell
     */
    public function create_shell($term_type = 'vanilla', $env = [], $width = 80, $height = 25, $width_height_type = SSH2_TERM_UNIT_CHARS) {
        return new shell($this->ssh, $term_type, $env, $width, $height, $width_height_type);
    }

    public function exec($command) {
        return new exec($this->ssh, $command);
    }
}
