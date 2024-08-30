# Installation

Follow these steps to install the module in Dolibarr:

1. Upload and install the module in Dolibarr.

2. Adjust the Dolibarr configuration file (`etc/dolibarr/conf.php`) and add the following at the end:

```php
   if (file_exists("/usr/share/dolibarr/htdocs/custom/xframework/remote/loader.php")) {
       require_once("/usr/share/dolibarr/htdocs/custom/xframework/remote/loader.php");
   }
```