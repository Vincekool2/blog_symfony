<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
?>
<H1>Test</H1>
<h2>Test 2</h2>
<h3>Test 3</h3>
<h4>Test 4</h4>
<h5>Test 5</h5>
<h6>Test 6</h6>

