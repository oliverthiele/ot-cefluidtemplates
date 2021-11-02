# EXT:ot_cefluidtemplates

## TYPO3 Extension

This extension for TYPO3 v11.5 allows the output of FluidTemplates.
All files in a folder to be configured and in the first subfolder can be selected as FluidTemplate by the editor.

### Installation

Composer Installation

```shell
composer require oliverthiele/ot-cefluidtemplates
```

Don't forget to add the TyppoScript in your root template.


### Configuration

In the backend module "Settings -> Extension Configuration" the path to the templates can be adjusted.
It would make sense to adjust to something like "EXT:my_sitepackage/Resources/Private/Conversions/Templates/".


