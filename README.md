![Bugfish](https://img.shields.io/badge/Bugfish-Dolibarr-orange)
![Status](https://img.shields.io/badge/Status-Finished-green)
![License](https://img.shields.io/badge/License-MIT-black)
![Version](https://img.shields.io/badge/Version-2.2-white)

Repository: https://github.com/bugfishtm/Bugfish-Dolibarr-Module  
Documentation: https://bugfishtm.github.io/Bugfish-Dolibarr-Module/  
You can find the available documentation in the repositories "docs" folder!


# Dolibarr Framework
This is the repository of the Bugfish Dolibarr Framework! It consists of a smaller functions file (dolibarr_functions.php) and a Dolibarr module. All functions from the dolibarr_functions.php are included in the module itself. This module does install the "Bugfish Framework", which documentation you can find here: https://bugfishtm.github.io/bugfish-framework.

In the documentation at the link at the top of this readme, you can find detailed informations about the dolibarr module and versioning related to the bugfish-framework. You can always update the bugfish framework inside the module yourself by putting the frameworks files into the "remote" directory of the installed dolibarr module. The dolibarr module serves different features, a short description of these features can be find below.


## Extension Functions (dolibarr_functions.php)

This Functions are already included in this Dolibarr Module. But if you want to use this functions without the module, you can include the file dolibarr_functions.php. Inside the Documentation (link at the top of this readme) can be found more information about different functions and detailed descriptions.

## Bugfish Dolibarr Module

A Dolibarr Module to add Development and Other usefull Coding and Logging Features, it can inercept MySQL and Javascript Errors. It has a full functional Changelog for different Internal areas and can serve messages for different modules if you are a developer!
You can install release files in this repositories "_release" folder directly in dolibarr. See documentation for Installation Information, as a line in dolibarr.conf needs to be changed. More information can be found in the documentation, see the link at the top of this readme file.

### Feature: Trigger and Object Logging
Triggers and object information related to that trigger are intercepted and can be viewed in the Triggers section under Utilities in the xFramework menu item.

### Feature: Javascript Error Logging
Javascript errors caused by users can be viewed in the log under Utilities -> xFramework -> Javascript Loggin.

### Feature: MySQL Error Logging
Only logging querys used with x_class_mysql.
MySQL error messages that arose when using the x_class_mysql can be viewed in the section under Utilities in the menu item xFramework.

### Feature: Changelog

The following areas are intercepted: facture bank_account facture_fourn commande propal user societe product orderpicking expedition supplier_proposal commande_fournisseur fichinter [These are the $ref] - Changes to the respective areas can be viewed under Utilities - xFramework - Process logs if you have the respective rights. The following fields are ignored: tms rowid Fields are marked with the following prefix for functions: mn [main table] xt [extrafield]

## Issues
If you encounter issues or have questions using this software, do not hesitate write us at our Forum on www.bugfish.eu/forum! Besides that you can always request help at request@bugfish.eu!

## License
For License Informations see License.md inside directories! This software is licensed with MIT License! The dolibarr Module may underlie other licensing restrictings, as it is a module extension of dolibarr itself and uses dolibarrs framework to exist.