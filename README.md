# Ocean-PHP-Wrapper
A PHP wrapper for interacting with the Ocean API Platform. 🌊

# Usage
1. Download or clone the repo.
2. Include the wrapper file in your chosen PHP file(s): `require_once 'ocean.wrapper.php'`.
3. Copy the code below or take a look at our docs to get started with our API.

```php
<?php

/* Require the wrapper file */
require_once 'ocean.wrapper.php';

/* Paylaod */
$math = array(
    'operation' => 'addition',
    'numbers' => [1,2]
);

$ocean = new Ocean\Core; //Start a new insatnce of Ocean API Wrapper
$ocean->key('YOUR_API_KEY'); //Your API key
$output = $ocean->get('https://ocean.blaze-cms.ga/api/math', $math); //Call an endpoint, provide data
var_dump($output); //Print output

?>
```

# Why should I use Ocean API? 🤔
Ocean API is a next gen API platform for smart yet basic applications. Our API is hand crafted for Discord bots, websites, and data storage.

# License 📜
OCean PHP Wrapper is distributed under the GNU General Public License v3.0 License. See `LICENSE` for more information.
