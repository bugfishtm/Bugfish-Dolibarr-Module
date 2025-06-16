# Bugfish Dolibarr Module [934285]

Seamlessly integrate the Bugfish Framework into Dolibarr for enhanced development and debugging.

-----------

## Introduction

This module integrates the Bugfish Framework into Dolibarr, providing additional functions, development tools, and useful coding and logging features. Key features include:

- Interception of MySQL and JavaScript errors
- A fully functional changelog for different internal areas
- Messaging capabilities for various modules (for developers)

### Manual Upgrade

To update the Bugfish Framework to a newer version, follow these steps:

1. **Download the Latest Version**
   - Visit the [Bugfish Framework GitHub repository](https://github.com/bugfishtm/bugfish-framework) and download the latest version.

2. **Move Files to the Correct Directory**
   - Extract the downloaded files and move the contents from the `_framework` folder to the `xframework/remote` folder of your Dolibarr installation. Overwrite any existing files if prompted.

3. **Update Files on Your Server**
   - If updating directly on your server, replace the old files with the new ones. Alternatively, you can create a new zip file of the updated framework and push it to the repository.

### Features

Below is a list of some module functionalities explained!

#### Trigger and Object Logging

Triggers and object information related to those triggers are intercepted and can be viewed in the Triggers section under Utilities in the xFramework menu item.

#### Javascript Error Logging

JavaScript errors caused by users can be viewed in the log under Utilities -> xFramework -> JavaScript Logging.

#### MySQL Error Logging

Only logging queries used with `x_class_mysql` are supported.

MySQL error messages that arise when using the `x_class_mysql` can be viewed in the section under Utilities in the menu item xFramework.

#### Changelog

The following areas are intercepted: `facture`, `bank_account`, `facture_fourn`, `commande`, `propal`, `user`, `societe`, `product`, `orderpicking`, `expedition`, `supplier_proposal`, `commande_fournisseur`, `fichinter` [These are the `$ref`]. Changes to the respective areas can be viewed under Utilities -> xFramework -> Process logs if you have the respective rights. The following fields are ignored: `tms`, `rowid`. Fields are marked with the following prefix for functions: `mn` [main table], `xt` [extrafield].

### Functions Overview

#### m_library

| Function Name                              | Description                                                                            |
|--------------------------------------------|----------------------------------------------------------------------------------------|
| `m_month_num_to_name($number)`             | Return Month Name or Error if Wrong (input number 1-12 to get German month name)       |
| `m_isset($var)`                            | If var is Empty or "" then false                                                        |
| `m_login_name_from_id($db, $userid)`       | Get the current name of User by UserID, if error then false                            |
| `m_login_id($db, $tmp = false)`            | Get the current rowID of logged in User, if error then false                           |

#### m_button

| Function Name                              | Description                                                                            |
|--------------------------------------------|----------------------------------------------------------------------------------------|
| `m_button_sql($db, $name, $url, $query, $get, $break = false, $style = "")` | Add a Button to Execute a Simple SQL! $msgerr = "Fehler!", $msgok = "Erfolgreich!" Function |
| `m_button_link($name, $url, $break = false, $style, $reacttourl = true)` | Add a Default Button Linked to another Page                                           |

#### m_table

| Function Name                              | Description                                                                            |
|--------------------------------------------|----------------------------------------------------------------------------------------|
| `m_table_simple($title, $array, $titlelist, $tableid, $alignarray = false, $imgeforlist = 'generic')` | Print a Simple Table                                                                 |
| `m_table_complex($title, $array, $titlelist, $formid = "", $alignarray = false, $imgeforlist = "generic")` | Print a Complex Table with Search                                                   |

#### m_mysql

| Function Name                              | Description                                                                            |
|--------------------------------------------|----------------------------------------------------------------------------------------|
| `m_db_rowsbycleanresult($db, $sql_res)`    | Get Array by providing a finished result                                               |
| `m_db_row($db, $query)`                    | Get a Single Array with $array["fieldname"] = $value back                             |
| `m_db_row_insert($db, $table, $array, $filter = true)` | Insert into a Database with array ["fieldname"] = $value                             |
| `m_db_rows($db, $query)`                   | Get a Multiple Array with $array[COUNT]["fieldname"] = $value back                    |

#### m_mastertable

| Function Name                              | Description                                                                            |
|--------------------------------------------|----------------------------------------------------------------------------------------|
| `__construct($db, $tabletitle, $tableid = "")` | Initialize with Dolibarr DB Object, Table Title, and optional unique id                |
| `addColumn($field_name, $view_name, $style = "", $enabled = true, $search = true, $sort = true, $sqlexec = false, $orderexec = false)` | Add a column with various attributes like field name, view name, and optional SQL execution details |
| `init($query, $default_limit = 50, $default_sort_order = "DESC", $default_sort_field = "rowid", $default_page = 1, $conf_paramsadd = "")` | Initialize table with SQL query, default settings for limit, sort order, and page |
| `prepareArray()`                          | Returns Array with fetched data from pre-used functions                               |
| `printTable($array, $tableimage = "", $cursiteurl = false, $hidelimit = 0, $hidetools = 0, $morecss = "", $nosuggestlstofpages = 1, $extraparam = array())` | Print a table with various display options and extra parameters                      |

####  Data Triggers

| Function                             | Description                                                                                                                                                                                                                                                                           |
|--------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `d_get_change($db, $refid, $ref, $fieldname)` | Get Array with `x[from]` and `x[to]`, or `false` if error. This function checks changes for a specific database field. <br /> **Parameters:** <br /> `Db` - Dolibarr DB object <br /> `$refid` - ID of the current object <br /> `$ref` - Table element <br /> `$fieldname` - Database field name to check |
| `d_is_change($db, $refid, $ref, $fieldname)`  | Returns `true` if the field has changed, `false` if not. May return an error if this is the first time this reference is added in the database. <br /> **Parameters:** <br /> `Db` - Dolibarr DB object <br /> `$refid` - ID of the current object <br /> `$ref` - Table element <br /> `$fieldname` - Database field name to check |

#### Logging

| Function                        | Description                                                                                                                                                                                                                   |
|---------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `d_message($db, $modulename, $message)` | Write a message to the module's message area. <br /> **Parameters:** <br /> `Db` - Dolibarr DB object <br /> `message` - Message to provide (filter with `$db->escape()` if needed) <br /> `modulename` - Name of the section in the message overview |


#### Fast MySQL/Mail Object and Integration of JS Functions

| Function                            | Description                                                                                                                       |
|-------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------|
| `x_c_mysql()`                       | Create a quick xMysql object without credentials.                                                                                |
| `x_c_mail($host, $port, $auth, $user, $pass, $from_name, $from_mail)` | Create a quick xMailer object. <br /> **Parameters:** <br /> `host` - Mail server host <br /> `port` - Mail server port (25/587/465) <br /> `auth` - Authentication method (tls/ssl/false) <br /> `user` - Username <br /> `pass` - Password <br /> `from_name` - Sender name <br /> `from_mail` - Sender email address |
| `x_l_js()`                         | Load content of JavaScript functions for JS files.                                                                                |


### Permissions

| Name             | Default Activated | Description                |
|------------------|--------------------|----------------------------|
| `readchangelogs` | No                 | View Change Logging        |
| `readtriggers`   | No                 | View Trigger Logging       |
| `readjs`         | No                 | View Javascript Logging    |
| `readmysql`      | No                 | View MySQL Logging         |
| `readmsg`        | No                 | View Messages Logging      |



-----------

## Tutorials  
Visit the [Tutorials Page](./tutorials.html) for a collection of step-by-step guides that will help you get the most out of the project. These tutorials cover everything from installation to advanced functionality.

-----------

## Downloads  
The [Downloads Section](./download.html) provides all the necessary files to get started with the project, including the latest software versions and any related resources.

-----------

## Installation  
Follow the clear and detailed instructions in our [Installation Guide](./installation.html) to set up the project. This guide will help you get everything running smoothly on your system.

-----------

## Contributing  
Find out how you can contribute to the project by visiting the [Contributing Page](./contributing.html). Whether you want to report bugs, suggest features, or submit improvements, we welcome your involvement.

-----------

## Warranty  
Review the terms of our warranty on the [Warranty Information Page](./warranty.html). This page outlines the scope of support and any applicable guarantees.

-----------

## Support  
If you need assistance, visit the [Support Page](./support.html) to find the available channels for getting help with any issues or questions you might have.

-----------

## License  
Get the full details on licensing by checking out the [License Information Page](./license.html). This section includes the terms and conditions under which the project is distributed.