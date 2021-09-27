<?php

namespace App\Command;

use App\Entity\AdminVar;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// php bin/console app:initAdminVar
class InitAdminVarCommand extends Command
{
    protected static $defaultName = 'app:initAdminVar';
    protected static $defaultDescription = 'initialize/reset Payment variable';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        
        $io = new SymfonyStyle($input, $output);
        /*
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }
        */

        $existingAdminVars = $this->entityManager->getRepository(AdminVar::class)->findAll();
        foreach ($existingAdminVars as $existingAdminVar) {
            $io->note('Removing existing data...');
            $this->entityManager->remove($existingAdminVar);
        }

        $adminVar = new AdminVar();
        $adminVar->setMoneyInCirculation(0);
        $adminVar->setAvailableRoyalties(0);
        $adminVar->setTotalRoyalties(0);
        $adminVar->setUpdateDate(new \DateTime('now'));

        $this->entityManager->persist($adminVar);
        $this->entityManager->flush();

        $io->success('You have a successfully reset payment data');

        return Command::SUCCESS;
    }
}
