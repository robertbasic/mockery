<?php

namespace Mockery\Generator\StringManipulation\Pass;

use Mockery\Generator\MockConfiguration;

class ConstantsPass implements Pass
{
    public function apply($code, MockConfiguration $config)
    {
        if (empty($config->getConstantsMap())) {
            return $code;
        }

        $constantsCode = '';
        foreach ($config->getConstantsMap() as $constant => $value) {
            $constantsCode = sprintf("\n    const %s = '%s';\n", $constant, $value);
        }

        $i = strrpos($code, '}');
        $code = substr_replace($code, $constantsCode, $i);
        $code .= "}\n";

        return $code;
    }
}
