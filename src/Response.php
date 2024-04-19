<?php

declare(strict_types=1);

namespace Verdient\SunYou;

use Verdient\http\Response as HttpResponse;
use Verdient\HttpAPI\AbstractResponse;
use Verdient\HttpAPI\Result;

/**
 * 响应
 * @author Verdient。
 */
class Response extends AbstractResponse
{
    /**
     * @inheritdoc
     * @author Verdient。
     */
    protected function normailze(HttpResponse $response): Result
    {
        $result = new Result();
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        $result->data = $body;
        $result->isOK = false;
        if ($statusCode >= 200 && $statusCode <= 300) {
            if (isset($body['ack']) && $body['ack'] === 'success') {
                $result->isOK = true;
            }
        }
        if (!$result->isOK) {
            $result->errorMessage = $body['errorMsg'] ?? $response->getStatusMessage();
        }
        return $result;
    }
}
