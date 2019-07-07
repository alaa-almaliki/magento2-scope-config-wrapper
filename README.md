# Magento 2 Scope Config

a wrapper module around scope config reader and writer

# How to install
`composer require alaa/magento2-scope-config-wrapper`

# Api

- Write interface `\Alaa\ScopeConfig\Model\ScopeConfigWriterInterface`
    - `$writer->saveWebsiteConfig($path, $value, $scopeId);`
    - `$writer->saveStoreConfig($path, $value, $scopeId);`
    - `$witer->saveDefaultConfig($path, $value);`
    - `$writer->saveConfig($path, $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);`
    - `$writer->deleteWebsiteConfig($path, $scopeId);`
    - `$writer->deleteStoreConfig($path, $scopeId);`
    - `$writer->deleteDefaultConfig($path);`
    - `$writer->deleteConfig($path, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);`

- Read interface `\Alaa\ScopeConfig\Model\ScopeConfigReaderInterface`
    - `$reader->getDefaultConfigValue(string $path);`
    - `$reader->getWebsiteConfigValue(string $path, $scopeId = null);`
    - `$reader->getStoreConfigValue(string $path, $scopeId = null);`
    - `$reader->getDefaultConfigFlag(string $path);`
    - `$reader->getWebsiteConfigFlag(string $path, $scopeId = null);`
    - `$reader->getStoreConfigFlag(string $path, $scopeId = null);`
    - `$reader->getConfigValue(string $path, string $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = null);`
    - `$reader->getConfigFlag(string $path, string $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = null);`

# Integration test
clear cache and run the below command

`php -f bin/magento alaa:scope-config:test`