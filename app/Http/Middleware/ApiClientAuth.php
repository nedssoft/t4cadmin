<?php

namespace App\Http\Middleware;

use Laravel\Passport\Bridge\ClientRepository;
use Illuminate\Auth\AuthenticationException;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use Closure;

class ApiClientAuth
{

    /**
     * The Client Repository
     *
     * @var \Laravel\Passport\Bridge\ClientRepository
     */
     private $clientRepository;
     
    /**
    * Create a new middleware instance.
    *
    * @param  \Laravel\Passport\ClientRepository  $clients
    * @return void
    */
    public function __construct(ClientRepository $clients)
    {
        $this->clientRepository = $clients;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @throws AuthenticationException
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Validate the request. If the request doesn't have client credentials,
        //it shouldn't be processed.
        $clientId = $request->client_id;
        if (is_null($clientId)) {
            throw new AuthenticationException('The request is missing a required parameter.');
        }

        // If the client is confidential require the client secret
        $clientSecret = $request->client_secret;

        //Authenticate the client
        $client = $this->clientRepository->getClientEntity(
            $clientId,
            $this->getIdentifier(),
            $clientSecret,
            true
        );

        if ($client instanceof ClientEntityInterface === false) {
            throw new AuthenticationException('Client Authentication Failed');
        }


        return $next($request);
    }

    /**
     * Get the identifier for this grant type
     *
     * @return string
     */
    public function getIdentifier()
    {
        return 'password';
    }
}