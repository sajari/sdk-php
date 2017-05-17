<?php

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('proto')
    ->exclude('Internal')
    ->in('src/Sajari')
;

return new Sami($iterator, [
    'title' => 'Sajari PHP SDK'
]);
