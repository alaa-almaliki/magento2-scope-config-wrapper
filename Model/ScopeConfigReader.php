<?php
/**
 * @copyright 2019 Alaa Al-Maliki
 */

declare(strict_types=1);

namespace Alaa\ScopeConfig\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class ScopeConfigReader
 *
 * @package Alaa\ScopeConfig\Model
 * @author  Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class ScopeConfigReader implements ScopeConfigReaderInterface
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * AbstractScopeConfig constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param string $path
     * @return null|string
     */
    public function getDefaultConfigValue(string $path)
    {
        return $this->getConfigValue($path);
    }

    /**
     * @param string $path
     * @param int|null $scopeId
     * @return null|string
     */
    public function getWebsiteConfigValue(string $path, $scopeId = null)
    {
        return $this->getConfigValue($path, ScopeInterface::SCOPE_WEBSITES, $scopeId);
    }

    /**
     * @param string $path
     * @param int|null $scopeId
     * @return null|string
     */
    public function getStoreConfigValue(string $path, $scopeId = null)
    {
        return $this->getConfigValue($path, ScopeInterface::SCOPE_STORES, $scopeId);
    }

    /**
     * @param string $path
     * @return bool
     */
    public function getDefaultConfigFlag(string $path)
    {
        return !!$this->getDefaultConfigValue($path);
    }

    /**
     * @param string $path
     * @param int|null $scopeId
     * @return bool
     */
    public function getWebsiteConfigFlag(string $path, $scopeId = null)
    {
        return !!$this->getWebsiteConfigValue($path, $scopeId);
    }

    /**
     * @param string $path
     * @param int|null $scopeId
     * @return bool
     */
    public function getStoreConfigFlag(string $path, $scopeId = null)
    {
        return !!$this->getStoreConfigValue($path, $scopeId);
    }

    /**
     * @param string $path
     * @param string $scope
     * @param int|null $scopeId
     * @return null|string
     */
    public function getConfigValue(
        string $path,
        string $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $scopeId = null
    ) {
        return $this->scopeConfig->getValue($path, $scope, $scopeId);
    }

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
    ) {
        return !!$this->getConfigValue($path, $scope, $scopeId);
    }
}
