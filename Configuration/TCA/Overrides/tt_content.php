<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

call_user_func(
    static function () {
        $ll = 'ot_cefluidtemplates.be:';

        if (!isset($GLOBALS['TCA']['tt_content']['types'])
            || !is_array($GLOBALS['TCA']['tt_content']['types'])) {
            $GLOBALS['TCA']['tt_content']['types'] = [];
        }

        if (!array_key_exists('ot_cefluidtemplates', $GLOBALS['TCA']['tt_content']['types'])
            || !is_array($GLOBALS['TCA']['tt_content']['types']['ot_cefluidtemplates'])) {
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

        if ((new Typo3Version())->getMajorVersion() >= 14) {
            $GLOBALS['TCA']['tt_content']['types']['ot_cefluidtemplates']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:ot_cefluidtemplates/Configuration/FlexForm/FlexForm.xml';
        } else {
            $GLOBALS['TCA']['tt_content']['columns']['pi_flexform']['config']['ds']['*,ot_cefluidtemplates'] = 'FILE:EXT:ot_cefluidtemplates/Configuration/FlexForm/FlexForm.xml';
        }

        /************************
         * Configure element type
         */
        $GLOBALS['TCA']['tt_content']['types']['ot_cefluidtemplates'] = array_replace_recursive(
            $GLOBALS['TCA']['tt_content']['types']['ot_cefluidtemplates'],
            [
                'showitem' => '
                --div--;core.form.tabs:general,
                    --palette--;frontend.ttc:palette.general;general,
                    --palette--;frontend.ttc:palette.headers;headers,
                --div--;ot_cefluidtemplates.be:tt_content.tabs.configuration,pi_flexform,
                --div--;frontend.ttc:tabs.appearance,
                    --palette--;frontend.ttc:palette.frames;frames,
                    --palette--;frontend.ttc:palette.appearanceLinks;appearanceLinks,
                --div--;core.form.tabs:language,
                    --palette--;;language,--div--;core.form.tabs:access,
                    --palette--;;hidden,--palette--;frontend.ttc:palette.access;access,
                --div--;core.form.tabs:categories,categories,
                --div--;core.form.tabs:notes,rowDescription,
                --div--;core.form.tabs:extended',
            ]
        );
    }
);
