# Dolibarr Module - xframework [934285]

This module integrates the Bugfish Framework into Dolibarr, providing additional functions, development tools, and useful coding and logging features. Key features include:

- Interception of MySQL and JavaScript errors
- A fully functional changelog for different internal areas
- Messaging capabilities for various modules (for developers)

### Compatibility Information

Here is the compatibility information for the Dolibarr Module and Bugfish Framework versions:

| Dolibarr Module Version | Framework Version (Bugfish-Framework) |
|--------------------------|----------------------------------------|
| 3.20                     | 3.20                                   |
| 3.10                     | 3.10                                   |
| 3.00                     | 3.00                                   |
| 2.90                     | 2.90                                   |
| 2.81                     | 2.75                                   |
| 2.8                      | 2.5                                    |
| 2.7                      | 2.4                                    |
| 2.6                      | 2.3                                    |
| 2.5                      | 2.2                                    |


## Updating the Bugfish Framework

To update the Bugfish Framework to a newer version, follow these steps:

1. **Download the Latest Version**
   - Visit the [Bugfish Framework GitHub repository](https://github.com/bugfishtm/bugfish-framework) and download the latest version.

2. **Move Files to the Correct Directory**
   - Extract the downloaded files and move the contents from the `_framework` folder to the `xframework/remote` folder of your Dolibarr installation. Overwrite any existing files if prompted.

3. **Update Files on Your Server**
   - If updating directly on your server, replace the old files with the new ones. Alternatively, you can create a new zip file of the updated framework and push it to the repository.

Feel free to reach out if you have any questions or need further assistance!
