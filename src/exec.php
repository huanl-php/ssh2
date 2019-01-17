<?php
/**
 *============================
 * author:Farmer
 * time:18-12-31 下午7:42
 * blog:blog.icodef.com
 * function:
 *============================
 */


namespace HuanL\SSH2;

/**
 * 执行命令
 * Class exec
 * @package HuanL\SSH2
 */
class exec implements ShellInterface {
    protected $ssh;

    protected $io;

    public function __construct($ssh, string $command, string $pty = '', array $env = [], int $width = 80, int $height = 25, int $width_height_type = SSH2_TERM_UNIT_CHARS) {
        $this->ssh = $ssh;
        $this->io = ssh2_exec($ssh, $command, $pty, $env, $width, $height, $width_height_type);
    }

    public function read($len = 1024) {
        return fread($this->io, $len);
    }

    public function getIOHandle() {
        return $this->io;
    }
}