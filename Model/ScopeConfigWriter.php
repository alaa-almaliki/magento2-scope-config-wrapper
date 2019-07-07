<?php
/**
 * @copyright 2019 Alaa Al-Maliki
 */

declare(strict_types=1);

namespace Alaa\ScopeConfig\Model;

use Magento\Framework\App\Config\ConfigResource\ConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;

/**
 * Class ScopeConfigWriter
 *
 * @package Alaa\ScopeConfig\Model
 * @author  Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class ScopeConfigWriter implements ScopeConfigWriterInterface
{
    /**
     * @var ConfigInterface
     */
    protected $configResource;

    /**
     * ScopeConfigWriter constructor.
     *
     * @param ConfigInterface $configResource
     */
    public function __construct(ConfigInterface $configResource)
    {
        $this->configResource = $configResource;
    }

    /**
     * @param string $path
     * @param string $value
     * @param int $scopeId
     */
    public function saveWebsiteConfig($path, $value, $scopeId)
    {
        $this->saveConfig($path, $value, ScopeInterface::SCOPE_WEBSITES, $scopeId);
    }

    /**
     * @param string $path
     * @param string $value
     * @param int $scopeId
     */
    public function saveStoreConfig($path, $value, $scopeId)
    {
        $this->saveConfig($path, $value, ScopeInterface::SCOPE_STORES, $scopeId);
    }

    /**
     * @param string $path
     * @param string $value
     */
    public function saveDefaultConfig($path, $value)
    {
        $this->saveConfig($path, $value);
    }

    /**
     * @param string $path
     * @param string $value
     * @param string $scope
     * @param int $scopeId
     */
    public function saveConfig(
        $path,
        $value,
        $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $scopeId = Store::DEFAULT_STORE_ID
    ) {
        $this->configResource->saveConfig($path, $value, $scope, $scopeId);
    }

    /**
     * @param string $path
     * @param string $scopeId
     */
    public function deleteWebsiteConfig($path, $scopeId)
    {
        $this->deleteConfig($path, ScopeInterface::SCOPE_WEBSITES, $scopeId);
    }

    /**
     * @param string $path
     * @param int $scopeId
     */
    public function deleteStoreConfig($path, $scopeId)
    {
        $this->deleteConfig($path, ScopeInterface::SCOPE_STORES, $scopeId);
    }

    /**
     * @param string $path
     */
    public function deleteDefaultConfig($path)
    {
        $this->deleteConfig($path, ScopeConfigInterface::SCOPE_TYPE_DEFAULT, 0);
    }

    /**
     * @param string $path
     * @param string $scope
     * @param int $scopeId
     */
    public function deleteConfig($path, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0)
    {
        $this->configResource->deleteConfig($path, $scope, $scopeId);
    }
}
