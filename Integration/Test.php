<?php
/**
 * @copyright 2019 Alaa Al-Maliki
 */

declare(strict_types=1);

namespace Alaa\ScopeConfig\Integration;

use Alaa\ScopeConfig\Model\ScopeConfigReader;
use Alaa\ScopeConfig\Model\ScopeConfigReaderInterface;
use Alaa\ScopeConfig\Model\ScopeConfigWriterInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Test
 *
 * @package Alaa\ScopeConfig\Integration
 * @author  Alaa Al-Maliki <alaa@thisislda.com>
 */
class Test
{
    /**
     * @var string
     */
    protected $testConfigPath = 'integration_test/%s_config_path/%s';

    /**
     * @var array
     */
    protected $paths = [];

    /**
     * @var ScopeConfigReader
     */
    protected $scopeConfigReader;

    /**
     * @var ScopeConfigWriterInterface
     */
    protected $scopeConfigWriter;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * Test constructor.
     *
     * @param ScopeConfigReaderInterface $scopeConfigReader
     * @param ScopeConfigWriterInterface $scopeConfigWriter
     * @param StoreManagerInterface $storeManager
     * @param ConsoleOutput $output
     */
    public function __construct(
        ScopeConfigReaderInterface $scopeConfigReader,
        ScopeConfigWriterInterface $scopeConfigWriter,
        StoreManagerInterface $storeManager,
        ConsoleOutput $output
    ) {
        $this->scopeConfigReader = $scopeConfigReader;
        $this->scopeConfigWriter = $scopeConfigWriter;
        $this->storeManager = $storeManager;
        $this->output = $output;
    }

    /**
     * Test All Scope Configs
     *
     * @throws NoSuchEntityException
     */
    public function test()
    {
        $this->testDefaultConfig();
        $this->testStoreConfig();
        $this->testWebsiteConfig();
    }

    /**
     * Tests Default Scope Config
     *
     * @throws NoSuchEntityException
     */
    protected function testDefaultConfig()
    {
        $adminStore = $this->storeManager->getStore(Store::DEFAULT_STORE_ID);
        $path = $this->getPath('default', $adminStore->getCode());
        $this->scopeConfigWriter->saveDefaultConfig($path, $adminStore->getName());
        $expectedValue = $this->scopeConfigReader->getDefaultConfigValue($path);

        if ($adminStore->getName() === $expectedValue) {
            $this->output->writeln('<info>Default Config Passed</info>');
        } else {
            $this->output->writeln('<error>Default Config Failed</error>');
        }
        $this->paths[] = [
            'scope' => 'default',
            'scope_id' => $adminStore->getId(),
            'path' => $path
        ];
    }

    /**
     * Test Store Scope Config
     */
    protected function testStoreConfig()
    {
        foreach ($this->storeManager->getStores() as $store) {
            $path = $this->getPath('stores', $store->getCode());
            $this->scopeConfigWriter->saveStoreConfig($path, $store->getName(), $store->getId());
            $expectedValue = $this->scopeConfigReader->getStoreConfigValue($path, $store->getId());

            if ($store->getName() === $expectedValue) {
                $this->output->writeln('<info>Store Config Passed</info>');
            } else {
                $this->output->writeln('<error>Store Config Failed</error>');
            }

            $this->paths[] = [
              'scope' => 'stores',
              'scope_id' => $store->getId(),
              'path' => $path,
            ];
        }
    }

    /**
     * Test Website Scope Config
     */
    protected function testWebsiteConfig()
    {
        foreach ($this->storeManager->getWebsites() as $website) {
            $path = $this->getPath('websites', $website->getCode());
            $this->scopeConfigWriter->saveWebsiteConfig($path, $website->getName(), $website->getId());
            $expectedValue = $this->scopeConfigReader->getWebsiteConfigValue($path, $website->getId());

            if ($website->getName() === $expectedValue) {
                $this->output->writeln('<info>Website Config Passed</info>');
            } else {
                $this->output->writeln('<error>Website Config Failed</error>');
            }

            $this->paths[] = [
                'scope' => 'websites',
                'scope_id' => $website->getId(),
                'path' => $path,
            ];
        }
    }

    /**
     * Deletes test data
     */
    public function deleteTestData()
    {
        foreach ($this->paths as $path) {
            $this->scopeConfigWriter->deleteConfig($path['path'], $path['scope'], $path['scope_id']);
        }
    }

    /**
     * @param string $scope
     * @param string $storeCode
     * @return string
     */
    protected function getPath(string $scope, string $storeCode): string
    {
        return sprintf($this->testConfigPath, $scope, $storeCode);
    }
}
