![Bugfish](https://img.shields.io/badge/Bugfish-Framework-orange)
![Status](https://img.shields.io/badge/Status-Finished-green)
![License](https://img.shields.io/badge/License-MIT-black)
![Version](https://img.shields.io/badge/Version-2.2-white)

# Dolibarr Framework

## Documentations
Look inside folders for readme and license informations! Documentations can be found in the docs folder. Just execute the index.html file in your webbrowser. (example: via drag and drop)

You can find the documentation at www.bugfish.eu, besides  that there is a documentation inside the docs folder of this repository and at https://bugfishtm.github.io/Bugfish-Dolibarr-Module !  

You can find the Documentation here:  
https://bugfishtm.github.io/Bugfish-Dolibarr-Module/

You can find the Github Page here:  
https://github.com/bugfishtm/Bugfish-Dolibarr-Module

## Informations

Here you can find a dolibarr Module which does connect the Bugfish-Framework PHP Functions and more with Dolibarr! It comes with unique functions like a logchange for different internal areas (factures, proposals and more!). You have a set of Dolibarr Optimized Functions which you can use for development and other debugging Tools inside that Module. For informations about the included Bugfish Framework it is Advised to check the Bugfish Frameworks Documentation inside the Release File of the fitting Dolibarr Module Version. The current latest Dolibarr Module Versions Bugfish Framework Version is 1.2.0. You can update the framework manually in the module by updating the framework files in the modules /remote folder! (If needed.)

You can find the documentation for the included bugfish Framework at this location! Be sure to use the documentation fitting the version inside this module of the bugfish framework. The current version is 1.2.0. You can find older documentations in the bugfish frameworks release files.  

Bugfish Framework Documentations: https://bugfishtm.github.io/bugfish-framework  
  
With Bugfish, you'll have the tools you need to create web applications that not only deliver wide-ranging functionality but also prioritize the highest standards of security, all while maintaining the flexibility to adapt to your unique project requirements. Join the Bugfish PHP Framework community and unlock the full potential of your web development endeavors.

Introducing the Bugfish PHP Framework: a powerful toolkit of classes and functions that not only offers extensive functionality, flexibility, and security but also provides a significant speed advantage, ensuring your web applications perform at their best.


## Dolibarr Function Library (m_*)

Presenting a collection of functions tailored for use with Dolibarr ERP CRM. These functions can be seamlessly integrated into your Dolibarr modules or effortlessly utilized via our dedicated Dolibarr CRM module within the framework. This integration ensures automatic function availability across all sections of Dolibarr. Explore the comprehensive list of functions below, complete with explanatory insights.You are searching something to improve your coding speed in dolibarr? Or may include our full framework with a dolibarr module? Hold on, you are at the right place! Explore the Bugfish Framework, a versatile solution that not only enhances Dolibarr ERP development but also extends its capabilities to a broader spectrum. This framework offers a specialized module to significantly improve coding speed, efficiency, and code quality while maintaining robust security. A standout feature of the Bugfish Framework is its adaptability. Seamlessly integrate it with Dolibarr for accelerated development, or utilize its core functions independently when needed. Elevate your Dolibarr ERP development and beyond with Bugfish Framework.

**You can use the functions as standalone without the module by including the function library php file in the repositories root folder!** 

## Module Features

Below a list of some Modules Functionalities explanations!

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
If you encounter issues or have questions using this software, do not hesitate write us at our Forum on www.bugfish.eu/forum !

## License
	For License Informations see License.md inside directories!