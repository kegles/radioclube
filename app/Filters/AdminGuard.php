<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Models\Socios;

class AdminGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!(new Socios())->isLogged())
        {
            return redirect()
                ->to('/entrar')->withCookies();
        }
        if (!(new Socios())->isAdministrador())
        {
            return redirect()
                ->to('/entrar')->withCookies()->with('error',_('Somente administradores do clube podem acessar essa função.'));
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}