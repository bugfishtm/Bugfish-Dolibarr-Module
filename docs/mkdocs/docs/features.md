# Features

Below is a list of some module functionalities explained!

## Feature: Trigger and Object Logging

Triggers and object information related to those triggers are intercepted and can be viewed in the Triggers section under Utilities in the xFramework menu item.

## Feature: Javascript Error Logging

JavaScript errors caused by users can be viewed in the log under Utilities -> xFramework -> JavaScript Logging.

## Feature: MySQL Error Logging

Only logging queries used with `x_class_mysql` are supported.

MySQL error messages that arise when using the `x_class_mysql` can be viewed in the section under Utilities in the menu item xFramework.

## Feature: Changelog

The following areas are intercepted: `facture`, `bank_account`, `facture_fourn`, `commande`, `propal`, `user`, `societe`, `product`, `orderpicking`, `expedition`, `supplier_proposal`, `commande_fournisseur`, `fichinter` [These are the `$ref`]. Changes to the respective areas can be viewed under Utilities -> xFramework -> Process logs if you have the respective rights. 

The following fields are ignored: `tms`, `rowid`. Fields are marked with the following prefix for functions: `mn` [main table], `xt` [extrafield].


