# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [5.0.0] — 2026-07-31

### Changed

- **Breaking:** Drop TYPO3 v13 support, require TYPO3 `^14.3`
- **Breaking:** Raise the PHP minimum to `>=8.4`
- Migrate the language files from XLIFF 1.2 to XLIFF 2.0. Unit identifiers and
  all translations are unchanged, so no label reference needs adjusting
- Reference labels via translation domain mapping instead of full file paths.
  `ot_cefluidtemplates.be:`, `core.form.tabs:` and `frontend.ttc:` replace the
  verbose `LLL:EXT:` references in the TCA overrides, the FlexForm and
  `page.tsconfig`

### Fixed

- The "Configuration" tab label was hardcoded in English in the TCA showitem.
  It now uses the new key `tt_content.tabs.configuration` and renders as
  "Konfiguration" in German
- The `original` attribute of `Resources/Private/Language/locallang_be.xlf`
  pointed at `EXT:gsw_website/Resources/Private/Language/locallang.xlf`, a
  leftover from an unrelated extension. TYPO3 resolves the translation
  fallback chain through this attribute

## [4.0.1] — 2026-07-28

Maintenance release — no functional changes.

### Changed

- Operator placement in multi-line conditions in the TCA overrides
- XLIFF files are indented with two spaces instead of tabs. The `.editorconfig`
  declared tabs for `*.xlf`, which contradicted the project convention, and is
  now aligned with the official TYPO3 root version

### Fixed

- PHPStan aborted before analysing: the configuration included
  `saschaegerer/phpstan-typo3` manually although `phpstan/extension-installer`
  already registers it, so every run failed on the duplicate include

## [4.0.0] — 2026-04-25

### Added

- TYPO3 v14.3 support (`^13.4||^14.3`)
- SiteKit configuration (`Configuration/SiteKit.yaml`)
- LICENSE file (GPL-2.0-or-later)

### Changed

- Raise PHP minimum constraint to `>=8.3`
- Drop TYPO3 v12 support
- FlexForm DS registration: version-aware (`columnsOverrides` for v14, pointer key for v13)
- Overhaul README to match documentation standard

## [3.1.0] — 2026-02-20

### Added

- TYPO3 v13 Site Set support

## [3.0.0] — 2025-01-04

### Changed

- TYPO3 v13 compatibility
- Code quality improvements (PHPStan)

## [2.0.3] — 2025-01-04

### Changed

- Code cleanup

## [2.0.2] — 2023-04-17

### Fixed

- Fix typo in page TSconfig import path

## [2.0.1] — 2023-04-17

### Changed

- Updates for TYPO3 v12 and PHP 8.1

## [2.0.0] — 2021-11-02

### Added

- Initial public release