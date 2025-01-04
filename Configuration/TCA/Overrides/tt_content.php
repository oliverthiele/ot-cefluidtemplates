<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

call_user_func(
    static function () {
        $ll = 'LLL:EXT:ot_cefluidtemplates/Resources/Private/Language/locallang_be.xlf:';

        if (!isset($GLOBALS['TCA']['tt_content']['types']) ||
            !is_array($GLOBALS['TCA']['tt_content']['types'])) {
            $GLOBALS['TCA']['tt_content']['types'] = [];
        }

        if (!array_key_exists('ot_cefluidtemplates', $GLOBALS['TCA']['tt_content']['types']) ||
            !is_array($GLOBALS['TCA']['tt_content']['types']['ot_cefluidtemplates'])) {
            $GLOBALS['TCA']['tt_content']['types']['ot_cefluidtemplates'] = [];
        }

        ExtensionManagementUtility::addPlugin(
            [
                'label' => $ll . 'wizard.title',
                'value' => 'ot_cefluidtemplates',
                'icon' => 'icon-ot-cefluidtemplate',
                'group' => 'extras',
                'description' => $ll . 'wizard.description',
            ],
            'CType',
            'ot_cefluidtemplates',
        );

        $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,ot_cefluidtemplates'] = 'FILE:EXT:ot_cefluidtemplates/Configuration/FlexForm/FlexForm.xml';

        /************************
         * Configure element type
         */
        $GLOBALS['TCA']['tt_content']['types']['ot_cefluidtemplates'] = array_replace_recursive(
            $GLOBALS['TCA']['tt_content']['types']['ot_cefluidtemplates'],
            [
                'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
                --div--;Configuration,pi_flexform,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,rowDescription,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
            ]
        );
    }
);
