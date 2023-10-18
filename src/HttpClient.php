<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/18 22:05
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Uri;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Weida\WeixinWorkClient\Contact\HttpClientInterface;

class HttpClient implements HttpClientInterface
{
    private Client $client;
    private array $httpConfig=[];
    private Config $config;
    public function __construct(Config $config)
    {
        $this->client= new Client();
        $this->config = $config;

    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     * @author Weida
     */
    public function send(RequestInterface $request, array $options = []): ResponseInterface
    {
        $this->httpConfig = $options;
        if(empty($request->getUri())){
            $request = $request->withUri((new Uri($this->getUri())));
        }
        return $this->client->send($request,$options);
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return PromiseInterface
     * @author Weida
     */
    public function sendAsync(RequestInterface $request, array $options = []): PromiseInterface
    {
        $this->httpConfig = $options;
        if(empty($request->getUri())){
            $request = $request->withUri((new Uri($this->getUri())));
        }
        return $this->client->sendAsync($request,$options);
    }

    /**
     * @param string $method
     * @param $uri
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     * @author Weida
     */
    public function request(string $method, $uri, array $options = []): ResponseInterface
    {
        $this->httpConfig = $options;
        if(empty($uri)){
            $uri = $this->getUri();
        }
        return $this->client->request($method,$uri,$options);
    }

    /**
     * @param string $method
     * @param $uri
     * @param array $options
     * @return PromiseInterface
     * @author Weida
     */
    public function requestAsync(string $method, $uri, array $options = []): PromiseInterface
    {
        $this->httpConfig = $options;
        if(empty($uri)){
            $uri = $this->getUri();
        }
        return $this->client->requestAsync($method,$uri,$options);
    }

    /**
     * @param string|null $option
     * @return mixed|null
     * @author Weida
     */
    public function getConfig(string $option = null): mixed
    {
        return $this->httpConfig[$option]??null;
    }

    /**
     * @return void
     * @author Weida
     */
    private function checkConfig(): void
    {
        if(!$this->config->has('host')){
            throw new InvalidArgumentException("no found host config");
        }
        if(!$this->config->has('client_id')){
            throw new InvalidArgumentException("no found client_id config");
        }
        if(!$this->config->has('gh_user_id')){
            throw new InvalidArgumentException("no found gh_user_id config");
        }
    }

    /**
     * @return string
     * @author Weida
     */
    private function getUri():string {
        $this->checkConfig();
        $uri = sprintf("%s/cmd?client_id=%s",$this->config->get('host'),$this->config->get('client_id'));
        return $uri;
    }

    /**
     * @param UriInterface| string $uri
     * @param array $data
     * @return ResponseInterface
     * @throws GuzzleException
     * @author Weida
     */
    public function postJson($uri, array $data): ResponseInterface
    {
        return $this->request('POST',$uri,['json'=>$data]);
    }
}
