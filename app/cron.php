<?php

use ZanySoft\Zip\Zip;

set_time_limit(0);
$spacer_size = 8; // increment me until it works
echo str_pad('', (1024 * $spacer_size), "\n"); // send 8kb of new line to browser (default), just make sure that this new line will not affect your code.
// if you have output compression, make sure your data will reach >8KB.

if(ob_get_level()) ob_end_clean(); // end output buffering

$zip = Zip::create(base_path('zips').'/'.date('Y-m-d').' - fotos.zip');
$zip->add(public_path('uploads'), true);
$zip->close();
