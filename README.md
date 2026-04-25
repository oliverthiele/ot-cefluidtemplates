# ot_cefluidtemplates — Fluid Template Content Element for TYPO3

TYPO3 content element for rendering Fluid templates selected by editors from a configured template directory. Useful for
recurring layout elements such as CTAs, teasers, or conversion blocks.

[![TYPO3](https://img.shields.io/badge/TYPO3-13.4-orange.svg)](https://typo3.org/)
[![Packagist Version](https://img.shields.io/packagist/v/oliverthiele/ot-cefluidtemplates.svg)](https://packagist.org/packages/oliverthiele/ot-cefluidtemplates)
[![PHP](https://img.shields.io/packagist/dependency-v/oliverthiele/ot-cefluidtemplates/php.svg)](https://php.net/)
[![License](https://img.shields.io/packagist/l/oliverthiele/ot-cefluidtemplates.svg)](LICENSE)
[![Changelog](https://img.shields.io/badge/Changelog-CHANGELOG.md-blue.svg)](CHANGELOG.md)

## Features

- Editors select a Fluid template from a backend select field
- Template path configurable via Extension Configuration
- Templates and partials managed in the sitepackage
- FlexForm configuration for per-record template path overrides
- TYPO3 v13 and v14 compatible (Site Set ready)

## Requirements

| Requirement | Version        |
|-------------|----------------|
| TYPO3       | ^13.4 \| ^14.3 |
| PHP         | >=8.3          |

## Installation

```bash
composer require oliverthiele/ot-cefluidtemplates
```

## Configuration

### Template Path

Set the base template path in the TYPO3 backend under **Settings → Extension Configuration → ot_cefluidtemplates**:

```
EXT:my_sitepackage/Resources/Private/Conversions/Templates/
```

### TypoScript

Configure template, partial, and layout root paths in your sitepackage:

```typoscript
tt_content {
    ot_cefluidtemplates {
        templateRootPaths {
            10 = EXT:my_sitepackage/Resources/Private/Conversions/Templates/
        }
        partialRootPaths {
            10 = EXT:my_sitepackage/Resources/Private/Conversions/Partials/
        }
        layoutRootPaths {
            10 = EXT:my_sitepackage/Resources/Private/Conversions/Layouts/
        }
    }
}
```

## Usage

### Template Directory Structure

All `.html` files in the configured directory and its first-level subdirectories are available to editors as a select
field. CamelCase filenames are automatically split into readable labels.

```
Templates/
├── SocialMedia/
│   └── SocialMediaShare.html   →  Group "Social Media" / Label "Social Media Share"
└── Teaser.html                 →  Label "Teaser"
```

### Why Use This Instead of the HTML Content Element

- Internal page links work via page ID (all ViewHelpers available)
- Templates are version-controlled in Git
- Editors cannot inject arbitrary HTML
- Easier to find strings in an IDE than in the database
- No duplication via "Insert Records" workarounds

## License

GPL-2.0-or-later — © Oliver Thiele
