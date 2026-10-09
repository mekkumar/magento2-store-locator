# Security Policy

## Supported Versions

Security support applies to releases explicitly marked as supported in the project's release notes.

## Reporting a Vulnerability

Please do not publish API keys, passwords, customer information or exploit details in a public issue.

Report suspected vulnerabilities privately through the repository owner's published contact method or GitHub's private vulnerability reporting feature, if enabled.

Include the affected version, reproduction steps and potential impact. Do not include real customer data or production secrets.

## Secret Handling

- Keep API keys and credentials outside source control.
- Use environment-specific configuration.
- Rotate any credential accidentally exposed.
- Review commit history if a secret is committed; deleting it from the latest version alone may not remove it from history.
