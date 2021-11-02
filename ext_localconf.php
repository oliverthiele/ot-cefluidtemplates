<?php

defined('TYPO3') or die();

call_user_func(
    function () {
        # *************************************************************
        # Add the CE FluidTemplates to the "New Content Element Wizard"
        # *************************************************************
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            '
mod.wizards.newContentElement.wizardItems.extras {
    header = Extras
    elements {
        ot_cefluidtemplates {
            iconIdentifier = content-special-div
            title = LLL:EXT:ot_cefluidtemplates/Resources/Private/Language/locallang_be.xlf:wizard.title
            description = LLL:EXT:ot_cefluidtemplates/Resources/Private/Language/locallang_be.xlf:wizard.description
            tt_content_defValues {
                CType = ot_cefluidtemplates
                header = CE Fluidtemplate
                header_layout = 100
            }
        }
    }
    show := addToList(ot_cefluidtemplates)
}
    '
        );
    }
);
