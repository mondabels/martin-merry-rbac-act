<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('user')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        if ($arguments) {
            $userRole = session('user')['role'] ?? '';

            // CI4 passes parameters as an array. e.g. filter: auth:admin,teacher -> $arguments = ['admin', 'teacher']
            if (!in_array($userRole, $arguments)) {
                session()->setFlashdata('error', 'You do not have permission to access this page.');

                // Redirect to the dedicated custom 403 page
                return redirect()->to('/unauthorized');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
