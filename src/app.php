<?php
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;

function is_leap_year($year = null){
    if (null === year) {
         $year = date('y');
    }
  
    return 0 === $year % 400 || (0 === $year %4 && 0 !== $year % 100);
}

$routes = new Routing\RouteCollection();

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => function ($request) {
        if (is_leap_year($request->attributes->get('year'))){
            return new Response('Sim, esse é um ano bissexto!');
        }

        return new Response('Não, esse não é um ano bissexto.');
     }
]));

$routes->add('hello', new Routing\Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => function ($request) {
        $request->attributes->set('foo', 'bar');
    
        $response = render_template($request);

        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }
]));

$routes->add('bye', new Routing\Route('/bye', [
    '_controller' => function ($request) {
        $response = render_template($request);

        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    } 
]));

return $routes;
