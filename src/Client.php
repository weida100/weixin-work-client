<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/14 21:31
 * Email: Sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient;

use Weida\WeixinWorkClient\Client\Room;
use Weida\WeixinWorkClient\Client\Login;
use Weida\WeixinWorkClient\Client\User;
use Weida\WeixinWorkClient\Contract\EncryptorInterface;
use Weida\WeixinWorkClient\Contract\HttpClientInterface;

final class Client
{
    private Config $config;
    private Room $room;
    private Login $login;
    private User $user;
    private HttpClientInterface $httpClient;
    private EncryptorInterface $encryptor;
    protected function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * 默认http,可以实现Tcp
     * @param HttpClientInterface $httpClient
     * @return $this
     * @author Weida
     */
    public function setHttpClient(HttpClientInterface $httpClient): Client
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @return HttpClientInterface
     * @author Weida
     */
    public function getHttpClient():HttpClientInterface {
        if(empty($this->httpClient)){
            $this->httpClient = new HttpClient($this->config(),$this->getEncryptor());
        }
        return $this->httpClient;
    }

    /**
     * @return EncryptorInterface
     * @author Weida
     */
    public function getEncryptor():EncryptorInterface{
        if(empty($this->encryptor)){
            $this->encryptor = new Encryptor();
        }
        return $this->encryptor;
    }


    /**
     * @return Login
     * @author Weida
     */
    public function login():Login{
        if(empty($this->login)){
            $this->login = new Login($this->getHttpClient());
        }
        return $this->login;
    }

    /**
     * @return User
     * @author Weida
     */
    public function user():User{
        if(empty($this->user)){
            $this->user = new User($this->getHttpClient());
        }
        return $this->user;
    }

    /**
     * @return Room
     * @author Weida
     */
    public function group():Room{
        if(empty($this->room)){
            $this->room = new Room($this->getHttpClient());
        }
        return $this->room;
    }

    /**
     * @return Config
     * @author Weida
     */
    public function config():Config {
        return $this->config;
    }






}
