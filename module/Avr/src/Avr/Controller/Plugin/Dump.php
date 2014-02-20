<?php

namespace Avr\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Dump extends AbstractPlugin {

    public function __invoke($var = null) {

        // var_dump the variable into a buffer and keep the output
        ob_start();
        var_dump($var);
        $content = ob_get_clean();

        // neaten the newlines and indents
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $content);

        $output = '<pre>'
                . $output
                . '</pre>';

        return $output;
    }

}

