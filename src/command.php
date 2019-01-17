<?php
/**
 *============================
 * author:Farmer
 * time:2019/1/17 20:49
 * blog:blog.icodef.com
 * function:
 *============================
 */

namespace HuanL\SSH2;


class command {

    /** @var ssh */
    public $ssh = null;

    public function initSSH($host, $port) {
        $this->ssh = new ssh($host, $port);
        if ($this->ssh->connect()) {
            $this->ssh = null;
            return false;
        }
        return $this->ssh;
    }

    public function getSSH() {
        return $this->ssh;
    }

    public function clearSSH() {
        $this->ssh = null;
    }

    public function exec($common) {
        if ($this->ssh) {
            return $this->ssh->exec($common);
        } else {
            return shell_exec($common);
        }
    }

    public function shell() {
        if ($this->ssh) {
            return $this->ssh->create_shell();
        } else {
            return false;
        }
    }

}