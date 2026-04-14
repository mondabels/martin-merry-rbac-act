<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class ApiAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getServer('HTTP_AUTHORIZATION');

        if (!$header) {
            return Services::response()
                ->setJSON(['error' => 'Unauthorized. Token is missing.'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        $token = null;
        if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            $token = $matches[1];
        }

        if (!$token) {
            return Services::response()
                ->setJSON(['error' => 'Unauthorized. Invalid token format.'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        $db = \Config\Database::connect();
        $apiToken = $db->table('api_tokens')->where('token', $token)->get()->getRow();

        if (!$apiToken || ($apiToken->expires_at !== null && $apiToken->expires_at < date('Y-m-d H:i:s'))) {
            return Services::response()
                ->setJSON(['error' => 'Unauthorized. Invalid or expired token.'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
