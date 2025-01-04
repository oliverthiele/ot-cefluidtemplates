# EXT:ot_cefluidtemplates

Version 3.0.0 for TYPO3 v12

## TYPO3 Extension

This extension for TYPO3 allows the output of FluidTemplates.
and is intended for recurring elements, which can be inserted by the editors on different pages
and should get a centrally defined layout.

But it can also be used as a replacement for the TYPO3 content element HTML.

This is often more useful for several reasons:

* Editors do not have to copy the HTML code from one content element to another multiple times or work with
  the TYPO3 content element "Insert Records" (which can then lead to unnecessary div containers with unwanted spacing).
* Links to internal pages work using the page ID, since all ViewHelpers can be used.
* Changes can be managed/deployed with Git.
* Editors can no longer include arbitrary HTML code.
* It's easier to find strings in an IDE than in the TYPO3 database.

### Installation

Composer Installation

```shell
composer require oliverthiele/ot-cefluidtemplates
```

### Configuration

#### Template path

In the backend module "Settings -> Extension Configuration" the path to the templates can be adjusted.
It would make sense to adjust to something like "EXT:my_sitepackage/Resources/Private/Conversions/Templates/".

#### TypoScript

Now the new path to the Fluid templates, layout and partials must be adjusted in your site package extension:

##### Example:

```typo3_typoscript
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

#### Template structure

All files in a folder to be configured and in the first subfolder can be selected as FluidTemplate by the editor.

It is important to consider in advance which folder structure you want to use, because the paths within the folder
are stored in the database without further mapping.

In the file names, CamelCase is automatically preceded by spaces.

##### Example:

The file path `my_sitepackage/Resources/Private/Conversions/Templates/SocialMedia/SocialMediaShare.html`
would be displayed to the editor in a select field as **"Social Media Share"** in the optgroup **"Social Media"**.
