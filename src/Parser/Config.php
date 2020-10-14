<?php

namespace QueridoDiario\Parser;

use Symfony\Component\Config\FileLocator;

class Config
{
    public const FORMAT_JSON = 'json';
    public const FORMAT_YML_ALIAS = 'yaml';
    public const FORMAT_YML = 'yml';
    public const FORMAT_PHP = 'php';
    public const FORMAT_DEFAULT = 'php';
    /**
     * @var array <mixed>
     */
    private $config = [];
    /**
     * Instantiate config
     *
     * @param string $configFilePath Path of scrapper.php file
     */
    public function __construct(string $configFilePath = '', string $parser = '')
    {
        $this->loadConfig($configFilePath, $parser);
    }

    /**
     * Parse the config file and load it into the config object
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input Input
     * @param \Symfony\Component\Console\Output\OutputInterface $output Output
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    protected function loadConfig(string $configFilePath = '', string $parser = '')
    {
        $configFilePath = $this->locateConfigFile($configFilePath);

        // If no parser is specified try to determine the correct one from the file extension.  Defaults to YAML
        if (!$parser) {
            $extension = pathinfo($configFilePath, PATHINFO_EXTENSION);

            switch (strtolower($extension)) {
                case self::FORMAT_JSON:
                    $parser = self::FORMAT_JSON;
                    break;
                case self::FORMAT_YML_ALIAS:
                case self::FORMAT_YML:
                    $parser = self::FORMAT_YML;
                    break;
                case self::FORMAT_PHP:
                default:
                    $parser = self::FORMAT_DEFAULT;
                    break;
            }
        }

        switch (strtolower($parser)) {
            case self::FORMAT_JSON:
                $config = json_decode(file_get_contents($configFilePath), true);
                break;
            case self::FORMAT_PHP:
                $config = include($configFilePath);
                break;
            case self::FORMAT_YML_ALIAS:
            case self::FORMAT_YML:
                $config = Yaml::parse(file_get_contents($configFilePath));
                break;
            default:
                throw new \Exception(sprintf('\'%s\' is not a valid parser.', $parser));
        }

        $this->config = $config;
    }

    /**
     * Returns config file path
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input Input
     *
     * @return string
     */
    protected function locateConfigFile(string $configFile = '')
    {
        $useDefault = false;

        if (!$configFile) {
            $useDefault = true;
        }

        if (!is_dir($configFile) && !is_file($configFile)) {
            $configFile = getcwd();
            if (!$configFile) {
                // @codeCoverageIgnoreStart
                throw new \Exception('Invalid config path', 1);
                // @codeCoverageIgnoreEnd
            }
        }

        $locator = new FileLocator([
            $configFile,
            $configFile . DIRECTORY_SEPARATOR,
            $configFile . DIRECTORY_SEPARATOR . 'config',
        ]);

        if (!$useDefault) {
            // Locate() throws an exception if the file does not exist
            return $locator->locate($configFile);
        }

        $this->config = require $locator->locate('scrapper.php');
        $possibleConfigFiles = ['scrapper.php', 'scrapper.json', 'scrapper.yaml', 'scrapper.yml'];
        foreach ($possibleConfigFiles as $configFile) {
            try {
                return $locator->locate($configFile);
            } catch (\Exception $exception) {
                $lastException = $exception;
            }
        }
        throw $lastException;
    }

    /**
     * Gets the config.
     *
     * @return <array>
     */
    public function getConfig()
    {
        return $this->config;
    }
}
