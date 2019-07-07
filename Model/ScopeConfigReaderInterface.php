<?php
/**
 * @copyright 2019 Alaa Al-Maliki
 */

declare(strict_types=1);

namespace Alaa\ScopeConfig\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Interface ScopeConfigReaderInterface
 *
 * @package Alaa\ScopeConfig\Model
 * @author  Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
interface ScopeConfigReaderInterface
{
    /**
     * @param string $path
     * @return string
     */
    public function getDefaultConfigValue(string $path);

    /**
     * @param string $path
     * @param int|null $scopeId
     * @return string
     */
    public function getWebsiteConfigValue(string $path, $scopeId = null);

    /**
     * @param string $path
     * @param int|null $scopeId
     * @return string
     */
    public function getStoreConfigValue(string $path, $scopeId = null);

    /**
     * @param string $path
     * @return bool
     */
    public function getDefaultConfigFlag(string $path);

    /**
     * @param string $path
     * @param int|null $scopeId
     * @return bool
     */
    public function getWebsiteConfigFlag(string $path, $scopeId = null);

    /**
     * @param string $path
     * @param int|null $scopeId
     * @return bool
     */
    public function getStoreConfigFlag(string $path, $scopeId = null);

    /**
     * @param string $path
     * @param string $scope
     * @param int|null $scopeId
     * @return string
     */
    public function getConfigValue(
        string $path,
        string $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $scopeId = null
    );

    /**
     * @param string $path
     * @param string $scope
     * @param int|null $scopeId
     * @return bool
     */
    public function getConfigFlag(
        string $path,
        string $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $scopeId = null
    );
}
