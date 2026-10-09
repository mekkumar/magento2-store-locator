# Installation

## Prerequisites

Install a Magento environment compatible with the module's declared PHP and Magento constraints.

## Install the Module

Place the module in:

`app/code/Kumar/StoreLocator`

Confirm that `registration.php`, `etc/module.xml`, and the required module files are present.

From the Magento project root, run:

```bash
php bin/magento module:enable Kumar_StoreLocator
php bin/magento setup:upgrade
php bin/magento cache:flush
```

In production mode, deploy static content and run the deployment commands required by your Magento release.

## Verify Installation

1. Open the Magento Admin panel.
2. Locate the Store Locator configuration section.
3. Configure the required map settings.
4. Add a demo store.
5. Open the frontend store locator route.
6. Confirm that store cards, marker icons and map details match.

## Notes

Exact routes, permissions, supported Magento versions and any additional setup requirements must be verified from the source code before publishing this guide.
