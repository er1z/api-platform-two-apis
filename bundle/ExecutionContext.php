<?php


namespace Er1z\MultiApiPlatform;


use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RequestContext;

class ExecutionContext
{
    private $api;
    /**
     * @var array
     */
    private $apis;
    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var ExpressionLanguage
     */
    private $expressionLanguage;
    /**
     * @var bool
     */
    private $isDebug;

    public function __construct(
        array $apis,
        RequestStack $requestStack,
        ExpressionLanguage $expressionLanguage,
        bool $isDebug = false
    )
    {
        $this->apis = $apis;
        $this->requestStack = $requestStack;
        $this->expressionLanguage = $expressionLanguage;
        $this->isDebug = $isDebug;
    }

    public function setApi(string $api)
    {
        // todo check if $api is defined
        $this->api = $api;
    }

    private function determineApiFromRequest(){

        $request = $this->requestStack->getMasterRequest();

        if(!$request){
            return null;
        }

        $requestContext = new RequestContext();
        $requestContext->fromRequest($request);

        foreach($this->apis as $k=>$v){
            if(!empty($v['conditions'])) {

                $expression = $v['conditions'];

                if ($this->expressionLanguage->evaluate($expression, ['context' => $requestContext, 'request' => $request])) {
                    return $k;
                }
            }


            // todo refactor this and above
            if($this->isDebug && !empty($v['debug_conditions'])){
                $expression = $v['debug_conditions'];

                if ($this->expressionLanguage->evaluate($expression, ['context' => $requestContext, 'request' => $request])) {
                    return $k;
                }
            }
        }

        return null;

    }

    public function classBelongsTo(string $class, array $apiData){
        if(!empty($apiData['namespace'])){
            if(substr($class, 0, strlen($apiData['namespace'])) == $apiData['namespace']){
                return true;
            }
        }

        if(!empty($apiData['implements'])){
            if(array_key_exists($apiData['implements'], class_implements($class))){
                return true;
            }
        }

        return false;
    }

    public function isClassAvailable(string $class): bool
    {

        if(is_object($class)){
            $class = get_class($class);
        }

        $api = $this->api ?? $this->determineApiFromRequest() ?? null;

        if(!$api){
            return false;
        }

        $apiData = $this->apis[$api];

        return $this->classBelongsTo($class, $apiData);
    }

}
