<?php

namespace Laralib\L5scaffold\Traits;

trait CommonTrait {
    protected function useUtf8Encoding($argument)
    {
        return iconv(mb_detect_encoding($argument, mb_detect_order(), true), "UTF-8", $argument);
    }
}