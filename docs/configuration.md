# Configuration Guide

This guide explains how to configure the `Kumar_StoreLocator` Magento 2 module.

## 1. Admin Configuration

1. Log in to the Magento Admin Panel.
2. Navigate to **Stores → Configuration**.
3. Find the Store Locator configuration section.
4. Review the available settings and configure them according to your store requirements.
5. Click **Save Config**.

*Note: The exact configuration section and available fields depend on the settings implemented in the installed module.*

## 2. Manage Store Locations

1. Open the Store Locator management section in Magento Admin.
2. Open the store listing page.
3. Add a new store or edit an existing store.
4. Enter the required store information.
5. Save your changes and verify the information on the storefront.

The available fields depend on the module's implementation.

## 3. Storefront

Open the configured Store Locator frontend route to view the store locator page.

Verify that:
- The page loads correctly.
- Store information is displayed as expected.
- The map and location functionality work if implemented and configured.
- The page is styled correctly on desktop and mobile devices.

## 4. Configuration Scope

If the module's settings support Magento configuration scopes, review the settings at the appropriate **Default Config**, **Website**, or **Store View** level.

Not every setting necessarily supports all scopes.

## 5. Troubleshooting

If configuration changes are not visible:

1. Confirm that the module is enabled.
2. Save the configuration again.
3. Clear the Magento cache:

   ```bash
   php bin/magento cache:clean
   ```

4. Check Magento logs under `var/log/` if errors occur.
5. Verify that the configured frontend route and layout handle match the module's implementation.

For installation instructions, see [Installation Guide](installation.md).

For known issues or assistance, see [Troubleshooting](troubleshooting.md).
