<?php


namespace Er1z\MultiApiPlatform\Command;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Command\SwaggerCommand as SwaggerCommandBase;
use Er1z\MultiApiPlatform\ExecutionContext;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SwaggerCommand extends Command
{

    /**
     * @var SwaggerCommandBase
     */
    private $base;
    /**
     * @var ExecutionContext
     */
    private $context;

    public function __construct(SwaggerCommandBase $base, ExecutionContext $context)
    {
        $this->base = $base;
        $this->context = $context;
        parent::__construct();
    }

    public function configure()
    {
        $this
            ->setName('api:swagger:export')
            ->setDescription('Dump the Swagger 2.0 (OpenAPI) documentation')
            ->addOption('yaml', 'y', InputOption::VALUE_NONE, 'Dump the documentation in YAML')
            ->addOption('output', 'o', InputOption::VALUE_OPTIONAL, 'Write output to file')
            ->addOption('api', 'a', InputOption::VALUE_OPTIONAL, 'API to process');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $api = $input->getOption('api');

        if($api) {
            $this->context->setApi($api);
        }

        return $this->base->run($input, $output);
    }


}