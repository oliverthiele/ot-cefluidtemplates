<?php

declare(strict_types=1);

/**
 * Copyright notice
 *
 * (c) 2025 Oliver Thiele <mail@oliver-thiele.de>, Web Development Oliver Thiele
 * All rights reserved
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * This copyright notice MUST APPEAR in all copies of the script!
 */

namespace OliverThiele\OtCefluidtemplates\UserFunc;

use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Adds template names to FlexForm select fields.
 */
final class FlexFormUserFunc
{
    /**
     * @param array{
     *     items?: array<int, array{0: string, 1: string}>,
     *     config?: array<string, mixed>,
     *     TSconfig?: string|null,
     *     table?: string,
     *     row?: array<string, mixed>,
     *     field?: string,
     *     effectivePid?: int,
     *     site?: \TYPO3\CMS\Core\Site\Entity\Site|null,
     *     inlineParentUid?: string,
     *     inlineParentTableName?: string,
     *     inlineParentFieldName?: string,
     *     inlineParentConfig?: array<string, mixed>,
     *     inlineTopMostParentUid?: string,
     *     inlineTopMostParentTableName?: string,
     *     inlineTopMostParentFieldName?: string,
     *     flexParentDatabaseRow?: array<string, mixed>
     * } $fConfig
     * @throws ExtensionConfigurationPathDoesNotExistException
     * @throws ExtensionConfigurationExtensionNotConfiguredException
     */
    public function getTemplateNames(array &$fConfig): void
    {
        $fConfig['items'] ??= [];
        $files = [];
        $dirs = [];
        $templatePath = '';

        /** @var array<string, mixed>|string|null $extensionSettings */
        $extensionSettings = GeneralUtility::makeInstance(ExtensionConfiguration::class)
            ->get('ot_cefluidtemplates');

        if (
            is_array($extensionSettings)
            && isset($extensionSettings['templates'])
            && is_string($extensionSettings['templates'])
            && $extensionSettings['templates'] !== ''
        ) {
            $templatePath = $extensionSettings['templates'];
        }

        if ($templatePath === '') {
            return;
        }

        if (preg_match_all('/^EXT:(.*)(\/.*)$/mU', $templatePath, $matches, PREG_SET_ORDER) === 0) {
            return;
        }

        $path = ExtensionManagementUtility::extPath($matches[0][1]);

        foreach (new \DirectoryIterator($path . $matches[0][2]) as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }

            if ($fileInfo->isFile()) {
                $templateName = $fileInfo->getBasename('.html');
                $files[] = [
                    'name' => $this->camelCaseToStartCase($templateName),
                    'id' => $templateName,
                ];
            } elseif ($fileInfo->isDir()) {
                $dirName = $fileInfo->getBasename();
                $dirs[] = [
                    'name' => $this->camelCaseToStartCase($dirName),
                    'id' => '--div--',
                ];

                foreach ($this->getFilesFromDirectory($fileInfo->getPathname(), $dirName) as $file) {
                    $dirs[] = $file;
                }
            }
        }

        $files = array_merge($files, $dirs);

        foreach ($files as $data) {
            $fConfig['items'][] = [
                $data['name'],
                $data['id'],
            ];
        }
    }

    /**
     * Get files from directory
     *
     * @return array<int, array{name: string, id: string}>
     */
    private function getFilesFromDirectory(string $path, string $dirName): array
    {
        $files = [];
        foreach (new \DirectoryIterator($path) as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }
            if ($fileInfo->isFile()) {
                $templateName = $fileInfo->getBasename('.html');
                $files[] = [
                    'name' => $this->camelCaseToStartCase($templateName),
                    'id' => $dirName . '/' . $templateName,
                ];
            }
        }
        return $files;
    }

    /**
     * Converts "CamelCase" to "Start Case"
     */
    private function camelCaseToStartCase(string $string): string
    {
        return trim((string)preg_replace('/(?<! )[A-Z][a-z]/', ' $0', $string));
    }
}
