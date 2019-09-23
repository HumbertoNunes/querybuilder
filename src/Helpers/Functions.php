<?php

function classTreatment($className)
{
    $className = explode('\\', $className);
    
    $className = end($className);

    $className = strtolower($className);

    return pluralizeSimpleNouns($className);
}

function pluralizeSimpleNouns(string $className): string
{

    $consonantBeforeY = '/[bcdfghjklmnpqrstvwxz]y$/';
    $manyEnds = '/ch$|s$|sh$|x$|z$/';
    $endsOnFOrFe = '/fe$|f$/';

    if (preg_match($consonantBeforeY, $className)) {
        return strtolower(preg_replace('/y$/', 'ies', $className));
    } elseif (preg_match($manyEnds, $className)) {
        return strtolower("{$className}es");
    } elseif (preg_match($endsOnFOrFe, $className)) {
        return strtolower(preg_replace('/fe$|f$/', 'ves', $className));
    } else {
        return strtolower("{$className}s");
    }
}
