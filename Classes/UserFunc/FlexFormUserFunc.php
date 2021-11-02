<?php

declare(strict_types=1);

namespace OliverThiele\OtCefluidtemplates\UserFunc;

use DirectoryIterator;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class FlexFormUserFunc
 * @package OliverThiele\OtCefluidtemplates\UserFunc
 */
class FlexFormUserFunc
{
    /**
     * @param  array  $fConfig
     * @return void
     * @throws ExtensionConfigurationPathDoesNotExistException
     * @throws ExtensionConfigurationExtensionNotConfiguredException
     */
    public function getTemplateNames(array &$fConfig): void
    {
        $files = [];
        $dirs = [];

        $extensionSettings = GeneralUtility::makeInstance(
            ExtensionConfiguration::class
        )->get('ot_cefluidtemplates', 'ot_cefluidtemplates');

        preg_match_all(
            '/^EXT:(.*)(\/.*)$/mU',
            $extensionSettings['templates'],
            $matches,
            PREG_SET_ORDER,
            0
        );
        $path = ExtensionManagementUtility::extPath($matches[0][1]);

        /** @var DirectoryIterator $fileInfo */
        foreach (new DirectoryIterator($path.$matches[0][2]) as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }

            if ($fileInfo->isFile()) {
                $templateName = $fileInfo->getBasename('.html');
                $files[] = [
                    'name' => $this->camelCaseTostartCase($templateName),
                    'id' => $templateName
                ];
            }
            if ($fileInfo->isDir()) {
                $dirName = $fileInfo->getBasename();
                $dirs[] = [
                    'name' => $this->camelCaseTostartCase($dirName),
                    'id' => '--div--'
                ];
                $filesInDirectory = $this->getFilesFromDirectory($fileInfo->getPathname(), $dirName);
                foreach ($filesInDirectory as $file) {
                    $dirs[] = $file;
                }
            }
        }
        $files = array_merge($files, $dirs);

        foreach ($files as $data) {
            $fConfig['items'][] = [
                $data['name'],
                $data['id']
            ];
        }
    }

    /**
     * @param  string  $path
     * @param  string  $dirName
     * @return array
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
                    'name' => $this->camelCaseTostartCase($templateName),
                    'id' => $dirName.'/'.$templateName
                ];
            }
        }
        return $files;
    }

    /**
     * Converts "CamelCase" to "Start Case"
     * @param  string  $string
     * @return string
     */
    private function camelCaseTostartCase(string $string)
    {
        return trim(preg_replace('/(?<! )[A-Z][a-z]/', ' $0', $string));
    }
}
