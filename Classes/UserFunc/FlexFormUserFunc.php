<?php

declare(strict_types=1);

namespace OliverThiele\OtCefluidtemplates\UserFunc;

use DirectoryIterator;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class FlexFormUserFunc
 */
class FlexFormUserFunc
{
    /**
     * @param array $fConfig
     * @throws ExtensionConfigurationPathDoesNotExistException
     * @throws ExtensionConfigurationExtensionNotConfiguredException
     */
    public function getTemplateNames(array &$fConfig): void
    {
        $files = [];
        $dirs = [];
        $templatePath = '';

        $extensionSettings = GeneralUtility::makeInstance(
            ExtensionConfiguration::class
        )->get('ot_cefluidtemplates');

        if (is_array($extensionSettings) && is_string(
                $extensionSettings['templates']
            ) && $extensionSettings['templates'] !== '') {
            $templatePath = $extensionSettings['templates'];
        }

        preg_match_all(
            '/^EXT:(.*)(\/.*)$/mU',
            $templatePath,
            $matches,
            PREG_SET_ORDER,
            0
        );
        $path = ExtensionManagementUtility::extPath($matches[0][1]);

        /** @var DirectoryIterator $fileInfo */
        foreach (new DirectoryIterator($path . $matches[0][2]) as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }

            if ($fileInfo->isFile()) {
                $templateName = $fileInfo->getBasename('.html');
                $files[] = [
                    'name' => $this->camelCaseToStartCase($templateName),
                    'id' => $templateName,
                ];
            }
            if ($fileInfo->isDir()) {
                $dirName = $fileInfo->getBasename();
                $dirs[] = [
                    'name' => $this->camelCaseToStartCase($dirName),
                    'id' => '--div--',
                ];
                $filesInDirectory = $this->getFilesFromDirectory($fileInfo->getPathname(), $dirName);
                foreach ($filesInDirectory as $file) {
                    $dirs[] = $file;
                }
            }
        }
        $files = [...$files, ...$dirs];

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
        /** @var DirectoryIterator $fileInfo */
        foreach (new DirectoryIterator($path) as $fileInfo) {
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
