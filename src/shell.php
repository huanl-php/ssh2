<?php
/**
 *============================
 * author:Farmer
 * time:18-12-31 下午7:36
 * blog:blog.icodef.com
 * function:
 *============================
 */


namespace HuanL\SSH2;

/**
 * 交互式的shell
 * Class shell
 * @package HuanL\SSH2
 */
class shell implements ShellInterface {
    protected $ssh;

    protected $io;

    public function __construct($ssh, string $term_type = 'vanilla', $env = [], $width = 80, $height = 25, $width_height_type = SSH2_TERM_UNIT_CHARS) {
        $this->ssh = $ssh;
        $this->io = ssh2_shell($ssh, $term_type, $env, $width, $height, $width_height_type);
    }

    /**
     * 获取io句柄
     * @return resource
     */
    public function getIOHandel() {
        return $this->io;
    }

    public function read() {
        return fread($this->io);
    }

    public function write($str) {
        return fwrite($this->io, $str);
    }

    /**
     * 设置堵塞
     * @param $mode
     * @return bool
     */
    public function blocking($mode) {
        return stream_set_blocking($this->io, $mode);
    }

}