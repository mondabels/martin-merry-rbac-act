<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class TeacherFilter implements FilterInterface
{
    protected array $allowedRoles = ['teacher', 'admin'];

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!in_array(session('user')['role'], $this->allowedRoles, true)) {
            return redirect()->to('/unauthorized');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
