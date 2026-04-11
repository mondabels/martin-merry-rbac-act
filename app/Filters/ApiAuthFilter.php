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
        // 1. Look for the "Authorization" header in the HTTP request
        $header = $request->getServer('HTTP_AUTHORIZATION');

        // 2. If it's missing entirely, reject the request
        if (!$header) {
            return Services::response()
                ->setJSON(['error' => 'Unauthorized. Token is missing.'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        // 3. The header should look like "Bearer abc123def456..."
        // We use regular expressions to extract just the token part
        $token = null;
        if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            $token = $matches[1];
        }

        // 4. If they sent "Authorization: <something else>" without "Bearer", reject it
        if (!$token) {
            return Services::response()
                ->setJSON(['error' => 'Unauthorized. Invalid token format.'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        // 5. Look in the database to see if this token actually exists
        $db = \Config\Database::connect();
        $apiToken = $db->table('api_tokens')->where('token', $token)->get()->getRow();

        // 6. If the token doesn't exist in our table, reject them
        if (!$apiToken) {
            return Services::response()
                ->setJSON(['error' => 'Unauthorized. Invalid or expired token.'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        // 7. If everything is good, we do nothing and the request safely moves to the Controller!
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // We don't need to do anything AFTER the controller is done, so we leave this empty
    }
}
