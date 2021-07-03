<?php

namespace App\Command;

use App\Services\Buying\IBuyingService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuyCommand extends Command
{
    protected static $defaultName = 'app:buy';

    public function __construct(private IBuyingService $buyingService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
        ->setDescription('Buy through console')
        ->setHelp('This command allows you to buy skipping the controller')
        ->addArgument('products', InputArgument::REQUIRED, 'Your Products');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $products = $input->getArgument('products');
        $buyingInfo = $this->buyingService->buy($products);
        $output->writeln('Buy Info: '.json_encode($buyingInfo));
        return Command::SUCCESS;
    }
}