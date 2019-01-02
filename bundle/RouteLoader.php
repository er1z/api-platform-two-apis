<?php


namespace Er1z\MultiApiPlatform;


use ApiPlatform\Core\Bridge\Symfony\Routing\ApiLoader;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\RouteCollection;

class RouteLoader implements \Symfony\Component\Config\Loader\LoaderInterface
{

    /**
     * @var ApiLoader
     */
    private $decorated;
    /**
     * @var array
     */
    private $apis;
    /**
     * @var bool
     */
    private $isDebug;
    /**
     * @var ExecutionContext
     */
    private $executionContext;

    public function __construct(
        ApiLoader $decorated,
        ExecutionContext $executionContext,
        array $apis,
        bool $isDebug
    )
    {
        $this->decorated = $decorated;
        $this->apis = $apis;
        $this->isDebug = $isDebug;
        $this->executionContext = $executionContext;
    }

    /**
     * Loads a resource.
     *
     * @param mixed       $resource The resource
     * @param string|null $type     The resource type or null if unknown
     *
     * @return \Symfony\Component\Routing\RouteCollection
     * @throws \Exception If something went wrong
     */
    public function load($resource, $type = null)
    {
        /**
         * @var $result RouteCollection
         */
        $result = $this->decorated->load($resource, $type);

        $iterator = $result->getIterator();
        foreach($iterator as $r){
            $class = $r->getDefault('_api_resource_class');

            if(!$class){
                continue;
            }

            $conditions = $this->getConditionsByClass($class);

            if(!$conditions){
                continue;
            }

            $r->setCondition($conditions);

        }

        return $result;
    }

    private function getConditionsByClass($class){

        foreach($this->apis as $api){
            if($this->executionContext->classBelongsTo($class, $api)){
                return $api[$this->isDebug ? 'debug_conditions' : 'conditions'];
            }
        }

        return null;
    }

    /**
     * Returns whether this class supports the given resource.
     *
     * @param mixed       $resource A resource
     * @param string|null $type     The resource type or null if unknown
     *
     * @return bool True if this class supports the given resource, false otherwise
     */
    public function supports($resource, $type = null)
    {
        return $this->decorated->supports($resource, $type);
    }

    /**
     * Gets the loader resolver.
     *
     * @return LoaderResolverInterface A LoaderResolverInterface instance
     */
    public function getResolver()
    {
        return $this->decorated->getResolver();
    }

    /**
     * Sets the loader resolver.
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
        $this->decorated->setResolver($resolver);
    }
}
