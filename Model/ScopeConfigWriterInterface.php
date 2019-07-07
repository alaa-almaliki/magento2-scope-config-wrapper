<?php
/**
 * @copyright 2019 Alaa Al-Maliki
 */

declare(strict_types=1);

namespace Alaa\ScopeConfig\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Interface ScopeConfigWriterInterface
 *
 * @package Alaa\ScopeConfig\Model
 * @author  Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
interface ScopeConfigWriterInterface
{
    /**
     * @param string $path
     * @param string $value
     * @param int $scopeId
     */
    public function saveWebsiteConfig($path, $value, $scopeId);

    /**
     * @param string $path
     * @param string $value
     * @param int $scopeId
     */
    public function saveStoreConfig($path, $value, $scopeId);

    /**
     * @param string $path
     * @param string $value
     */
    public function saveDefaultConfig($path, $value);

    /**
     * @param string $path
     * @param string $value
     * @param string $scope
     * @param int $scopeId
     */
    public function saveConfig($path, $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);

    /**
     * @param string $path
     * @param string $scopeId
     */
    public function deleteWebsiteConfig($path, $scopeId);

    /**
     * @param string $path
     * @param int $scopeId
     */
    public function deleteStoreConfig($path, $scopeId);

    /**
     * @param string $path
     */
    public function deleteDefaultConfig($path);

    /**
     * @param string $path
     * @param string $scope
     * @param int $scopeId
     */
    public function deleteConfig($path, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
}
