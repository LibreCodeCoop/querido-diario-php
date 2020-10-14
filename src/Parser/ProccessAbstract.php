<?php
namespace QueridoDiario\Parser;

use Generator;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

abstract class ProccessAbstract
{
    /**
     * Cliente que fará as requisições
     *
     * @var HttpBrowser
     */
    public $client;
    /**
     * URL base para as requisições
     *
     * @var string
     */
    protected $baseUrl;
    /**
     * Máximo de requisições que serão feitas, se 0 fará quantas for necessário
     *
     * @var integer
     */
    protected $maxRequests = 0;
    /**
     * @param array<mixed> $settings
     */
    public function __construct(array $settings = [])
    {
        $this->baseUrl = $settings['baseUrl'] ?? $this->baseUrl;
        $this->maxRequests = $settings['maxRequests'];
        $this->client = new HttpBrowser(HttpClient::create(['verify_peer' => false]));
    }

    /**
     * Search by date using a list of search strings
     *
     * @param string $date Format d-m-Y
     * @return Generator<Gazette>
     */
    abstract public function collectData(string $date = ''): Generator;
}
