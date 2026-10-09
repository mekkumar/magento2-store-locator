# Troubleshooting Guide

This guide covers common issues you may encounter when using the Kumar Store Locator module for Magento 2.

## 1. Store Locator Page Is Not Loading

**Possible causes:**
- The module is disabled.
- The frontend route is incorrect.
- The layout XML handle does not match the route and controller action.

**Solutions:**

Check the module status:

```bash
php bin/magento module:status Kumar_StoreLocator
```

If the module is disabled, enable it:

```bash
php bin/magento module:enable Kumar_StoreLocator
php bin/magento setup:upgrade
php bin/magento cache:flush
```

Verify that the frontend route in `etc/frontend/routes.xml` matches the URL you are opening.

Also verify that the corresponding layout XML file exists under `view/frontend/layout/`.

## 2. Store Locations Are Not Displayed

**Possible causes:**
- No store records have been created.
- Store information has not been saved correctly.
- The model or collection is not returning the expected records.

**Solutions:**

1. Open the Store Locator management section in Magento Admin.
2. Check whether store records exist.
3. Create or update a store record and save it.
4. Check Magento logs for database or application errors.

## 3. Map Is Not Displayed

If the module implements map functionality and the map does not appear:

1. Open the browser developer console.
2. Check for JavaScript errors.
3. Verify that the map container exists in the storefront HTML.
4. Check whether the required JavaScript library or external map service is loading.
5. Verify any required API configuration, if applicable.

The exact solution depends on the map provider and implementation used by the module.

## 4. Admin Menu or Store Management Page Is Missing

**Possible causes:**
- The module is disabled.
- The admin route or menu configuration is incorrect.
- The logged-in admin user does not have the required ACL permissions.

**Solutions:**

1. Verify that the module is enabled.
2. Check `etc/adminhtml/routes.xml`.
3. Check `etc/adminhtml/menu.xml` and `etc/acl.xml`.
4. Confirm that the admin user role has the required permissions.
5. Clear the Magento cache.

## 5. Configuration Changes Are Not Visible

Run:

```bash
php bin/magento cache:clean
```

If the changes involve database schema or module setup, run:

```bash
php bin/magento setup:upgrade
```

Avoid running setup commands unnecessarily in production environments.

## 6. Check Magento Logs

Review the following files for errors:

- `var/log/system.log`
- `var/log/exception.log`
- `var/log/debug.log`, if enabled

Also inspect the browser developer console for frontend JavaScript errors.

## 7. Still Need Help?

Before reporting an issue, include:

- Magento version
- PHP version
- Module version
- Steps to reproduce the issue
- Expected and actual behavior
- Relevant error messages or sanitized logs

Please remove passwords, access tokens, API keys, and other sensitive information before sharing logs.

For installation instructions, see the [Installation Guide](installation.md).

For configuration instructions, see the [Configuration Guide](configuration.md).

To report a bug, use the repository's GitHub Issues page.
