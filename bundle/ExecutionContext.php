<?php


namespace Er1z\MultiApiPlatform;


use Symfony\Component\HttpFoundation\RequestStack;

class ExecutionContext
{
    private $api;
    /**
     * @var array
     */
    private $apis;

    public function __construct(array $apis)
    {
        $this->apis = $apis;
    }


    public function setApi(string $api)
    {
        // todo check if $api is defined
        $this->api = $api;
    }

    public function isClassAvailable($class): bool
    {
        foreach($this->apis as $api){
            //
        }

        return false;
    }

}