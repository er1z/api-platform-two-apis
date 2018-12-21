<?php


namespace App\ApiPlatform;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class ContextDiscriminator
{

    /**
     * @var RequestStack
     */
    private $requestStack;
    private $isInternalEnv;

    public function __construct(bool $isInternalEnv, ?RequestStack $requestStack = null)
    {
        $this->requestStack = $requestStack;
        $this->isInternalEnv = $isInternalEnv;
    }

    public function isInternal(?Request $request = null)
    {
        $request = $request ?? $this->requestStack->getMasterRequest();
        if(!$request){
            return $this->isInternalEnv;
        }

        return $request->headers->has('x-internal') || $request->query->has('is_internal');
    }

}