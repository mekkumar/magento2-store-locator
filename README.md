# Magento 2 Store Locator

A Magento 2 extension for managing store locations through the Magento Admin panel and presenting store information on the storefront. The project is designed to support a searchable store locator experience with location details and map-based navigation, depending on the features implemented in the current release.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Screenshots](#screenshots)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Managing Store Locations](#managing-store-locations)
- [Storefront Usage](#storefront-usage)
- [Development and Testing](#development-and-testing)
- [Troubleshooting](#troubleshooting)
- [Documentation](#documentation)
- [Security](#security)
- [Contributing](#contributing)
- [Support](#support)
- [License](#license)
- [Disclaimer](#disclaimer)

## Overview

The Magento 2 Store Locator project provides a foundation for managing physical store locations and making store information accessible to customers through a storefront interface.

Store locator functionality can help customers find store addresses, review contact information and explore available locations. Depending on the implementation, the interface may also provide map markers, store information windows, search filters and additional store details.

This module is intended for Magento developers, merchants and contributors who want to explore or extend store locator functionality within a Magento 2 environment.

## Features

The project is designed around the following capabilities. Actual availability depends on the implementation and configuration in the current release.

### Store Management

- Manage store locations through the Magento Admin panel.
- Create, edit and delete store records.
- Maintain store names, addresses and contact details.
- Store geographical coordinates for map-based functionality.
- Maintain additional store information, where supported.

### Storefront Experience

- Display store information through a dedicated storefront page.
- Present store details using a store listing or card-based interface.
- Support map markers and information windows, where implemented.
- Support store search and location-based filtering, where implemented.
- Display opening hours, ratings and available services, where supported.

### Configuration

- Configure default map location and search radius, if supported.
- Configure default and active map marker images, if supported.
- Maintain module settings through Magento configuration, where available.

### Development

- Magento module registration and configuration.
- Database schema definition for store data.
- Separate frontend and adminhtml layouts and templates.
- Frontend JavaScript and CSS assets.
- Sample data for development and demonstration, if included.

> Not every listed capability is necessarily enabled in every release. Check the current source code and configuration before relying on a specific feature.

## Screenshots

<img width="1672" height="941" alt="Store Locator Admin Dashboard Mockup-1" src="https://github.com/user-attachments/assets/57b7d95e-db60-4454-b3cb-d3582e9a9df0" />



<img width="878" height="896" alt="image" src="https://github.com/user-attachments/assets/dd723e6a-0d73-44e6-a334-8423370ae51a" />

Screenshots are provided for visual reference. The appearance and available functionality may vary depending on the installed version and configuration.

## Requirements

Before installing the module, ensure that your environment includes:

- A compatible Magento Open Source or Adobe Commerce installation.
- PHP and Composer versions supported by your Magento installation.
- A database supported by your Magento installation.
- Appropriate filesystem permissions for Magento module files.
- Google Maps API credentials, if the implementation uses Google Maps and requires an API key.

**Compatibility:** Verify the supported Magento, PHP and dependency versions against the project's `composer.json` and test the module in your target environment. Compatibility with every Magento release is not guaranteed.

## Installation

### 1. Copy the Module

Place the module in your Magento project's application code directory:

```text
app/code/Kumar/StoreLocator/
```

The module directory should contain files such as:

```text
Kumar/StoreLocator/
├── Block/
├── Controller/
├── Model/
├── etc/
├── view/
├── composer.json
└── registration.php
```

The exact directory structure may evolve as the project develops.

### 2. Enable the Module

From your Magento project root, run:

```bash
php bin/magento module:enable Kumar_StoreLocator
```

### 3. Run Magento Setup Upgrade

```bash
php bin/magento setup:upgrade
```

This command registers the module and applies any required database schema or setup changes.

### 4. Clear the Cache

```bash
php bin/magento cache:flush
```

### 5. Verify the Installation

Check the module status:

```bash
php bin/magento module:status Kumar_StoreLocator
```

Confirm that `Kumar_StoreLocator` is listed as enabled.

For detailed installation instructions, see the [Installation Guide](docs/installation.md).

## Configuration

Configuration options depend on the settings implemented in the current release.

If the module provides administrative configuration:

1. Sign in to Magento Admin.
2. Navigate to **Stores → Configuration**.
3. Locate the Store Locator configuration section.
4. Review the available options.
5. Save the configuration and clear the cache if necessary.

Depending on the implementation, settings may include map defaults, marker images, search radius or other store locator preferences.

Do not assume that a setting is available unless it appears in the module's configuration or administrative interface.

For additional information, see the [Configuration Guide](docs/configuration.md).

## Managing Store Locations

If store management is enabled in the installed version:

1. Open the Store Locator management section in Magento Admin.
2. Review the existing store records.
3. Create a new store or edit an existing one.
4. Enter the required store details.
5. Save the record.
6. Verify the resulting information on the storefront.

Available fields depend on the implementation. They may include:

- Store name
- Street address and city
- Postal code and country
- Telephone and email
- Latitude and longitude
- Opening hours
- Store rating or services

Only use fields that are actually supported by the installed module.

## Storefront Usage

The frontend route depends on the route configuration in `etc/frontend/routes.xml`.

For a module configured with the `kumar-stores` frontend route, the storefront URL may be:

```text
https://your-magento-domain.example/kumar-stores
```

Replace the example domain with your Magento storefront domain.

Depending on the implementation, visitors may be able to browse store information, search for locations or interact with a map.

If the page does not load, verify the frontend route, controller action and corresponding layout handle.

## Development and Testing

Developers can extend the module by working with its Magento components.

| Component | Purpose |
|---|---|
| `Block/` | Blocks used by frontend or admin templates |
| `Controller/` | Frontend and administrative request handling |
| `Model/` | Store data and business logic |
| `Model/ResourceModel/` | Database persistence and collections |
| `etc/` | Module, route, ACL, schema and configuration definitions |
| `view/frontend/` | Storefront layouts, templates, JavaScript and CSS |
| `view/adminhtml/` | Admin layouts and templates |

### Suggested Verification Checklist

After making changes, verify the following in a development environment:

- [ ] The module is enabled.
- [ ] Magento setup upgrade completes successfully.
- [ ] The storefront route loads.
- [ ] Store records can be managed, if supported.
- [ ] Store information appears correctly on the storefront.
- [ ] Administrative permissions behave as expected.
- [ ] JavaScript and CSS assets load without errors.
- [ ] The browser console and Magento logs show no relevant errors.

Run `setup:upgrade` when module setup or schema changes require it. For layout, template or static asset changes, cache cleaning and the appropriate static content deployment steps may be sufficient.

## Troubleshooting

### Store Locator Page Does Not Load

- Verify that the module is enabled.
- Check the frontend route in `etc/frontend/routes.xml`.
- Confirm that the controller action and layout handle match.
- Clear the Magento cache.

### Store Information Is Missing

- Confirm that store records exist.
- Check whether the records were saved successfully.
- Review the model, collection and template logic.
- Inspect Magento logs for database or application errors.

### Map Is Not Displayed

If map functionality is implemented:

- Check the browser developer console.
- Confirm that the map container exists.
- Verify that the required JavaScript library loads.
- Check API credentials and provider configuration, if applicable.

### Admin Menu Is Missing

- Verify the admin route and menu configuration.
- Check the ACL resource definitions.
- Confirm that the admin user role has the required permissions.
- Clear the Magento cache.

For more troubleshooting steps, see the [Troubleshooting Guide](docs/troubleshooting.md).

## Documentation

Additional documentation is available in the `docs/` directory:

- [Installation Guide](docs/installation.md) — module installation and setup.
- [Configuration Guide](docs/configuration.md) — available settings and configuration guidance.
- [Troubleshooting Guide](docs/troubleshooting.md) — common issues and debugging steps.

## Demo Data

Any example store names, addresses, telephone numbers, ratings, opening hours and geographical coordinates used in screenshots, sample data or documentation are illustrative unless explicitly identified otherwise.

Do not treat demonstration data as verified real-world business listings.

## Security

Please follow these security practices when using or contributing to the project:

- Never commit API keys, passwords, access tokens or other secrets.
- Do not commit production environment files or database dumps.
- Remove personal or customer information from logs before sharing them.
- Validate and sanitize user-supplied data.
- Apply appropriate Magento ACL permissions to administrative actions.
- Keep Magento, PHP and third-party dependencies updated.

Read the [Security Policy](SECURITY.md) for reporting security vulnerabilities.

## Contributing

Contributions, bug reports and suggestions are welcome.

Before submitting a contribution:

1. Review the existing project structure and implementation.
2. Keep changes consistent with Magento development conventions.
3. Test changes in a compatible development environment.
4. Avoid committing credentials, generated files or unrelated changes.
5. Provide a clear description of the problem and the proposed solution.

See [CONTRIBUTING.md](CONTRIBUTING.md) for contribution guidelines.

## Support

If you encounter a problem, please provide:

- Magento and PHP versions.
- The module version or commit.
- Steps to reproduce the issue.
- Expected and actual behavior.
- Relevant error messages or sanitized logs.

For project-specific support, see [SUPPORT.md](SUPPORT.md). You can also report bugs through the repository's GitHub Issues page.

## License

This project is distributed under the [MIT License](LICENSE).

Third-party dependencies, map services, images and other assets may be subject to separate license terms. Review their respective licenses and usage requirements before redistribution or commercial use.

## Disclaimer

This is an independently maintained project and is not an official Magento or Adobe product. Magento and Adobe Commerce are trademarks of their respective owners.

Google Maps and other third-party services are subject to their respective terms, licensing conditions and usage policies.
