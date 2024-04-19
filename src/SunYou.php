<?php

declare(strict_types=1);

namespace Verdient\SunYou;

use Verdient\HttpAPI\AbstractClient;

/**
 * 顺友
 * @author Verdient。
 */
class SunYou extends AbstractClient
{
    /**
     * 用户秘钥
     * @author Verdient。
     */
    protected string $apiLogUserToken = '';

    /**
     * 开发者秘钥
     * @author Verdient。
     */
    protected string $apiDevUserToken = '';

    /**
     * 代理主机
     * @author Verdient。
     */
    protected ?string $proxyHost = null;

    /**
     * 代理端口
     * @author Verdient。
     */
    protected int|string|null $proxyPort = null;

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public $request = Request::class;

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public function request($path): Request
    {
        $request = parent::request($path);
        $request->addHeader('apiLogUserToken', $this->apiLogUserToken);
        $request->addHeader('apiDevUserToken', $this->apiDevUserToken);
        if ($this->proxyHost) {
            $request->setProxy($this->proxyHost, empty($this->proxyPort) ? null : intval($this->proxyPort));
        }
        return $request;
    }
}
