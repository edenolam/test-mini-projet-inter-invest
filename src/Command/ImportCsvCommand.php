<?php


namespace App\Command;

use App\Entity\FormeJuridique;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCsvCommand extends Command
{
    protected static $defaultName = 'app:import-csv';
    protected static $defaultDescription = 'import csv';
//    private string $csv; // La route du fichier csv est importée grâce au fichier services.yaml
    private EntityManagerInterface $manager;

    /**
     * ImportCommand constructor.
//     * @param string $csv
     * @param EntityManagerInterface $manager
     */
    public function __construct(
//        string $csv,
        EntityManagerInterface $manager
    )
    {
        parent::__construct(self::$defaultName);
        $this->manager = $manager;
//        $this->csv = $csv;
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
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
//            if (($handle = fopen($this->csv, "r")) !== false) {
//            while (($line = fgetcsv($handle, 1000, ",")) !== false) {
//                $formeJuridique = (new FormeJuridique())
//                    ->setStatut($line[0]);
//                $this->manager->persist($formeJuridique);
//            }
//            fclose($handle);
//        }
        $this->manager->flush();
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }

}

//
//namespace App\Command;
//
//use App\Entity\FormeJuridique;
//use Doctrine\ORM\EntityManagerInterface;
//use Symfony\Component\Console\Command\Command;
//use Symfony\Component\Console\Input\InputInterface;
//use Symfony\Component\Console\Output\OutputInterface;
//use Symfony\Component\Console\Style\SymfonyStyle;
//
//class ImportCsvCommand extends Command
//{
//    protected static $defaultName = 'app:import-csv';
//
//    private string $csv; // La route du fichier csv est importée grâce au fichier services.yaml
//
//    private EntityManagerInterface $manager;
//
//    /**
//     * ImportCommand constructor.
//     * @param string $csv
//     * @param EntityManagerInterface $manager
//     */
//    public function __construct(string $csv, EntityManagerInterface $manager, $projectDir)
//    {
//$this->projectDir = $projectDir;
//        parent::__construct(self::$defaultName);
//        $this->csv = $csv;
//        $this->manager = $manager;
//    }
//
//    protected function configure()
//    {
//        $this->setDescription('Import de forme juridique à partir d\'un fichier csv');
//    }
//
//    protected function execute(InputInterface $input, OutputInterface $output): int
//    {
//        $io = new SymfonyStyle($input, $output);
//
//        if (($handle = fopen($this->csv, "r")) !== false) {
//            while (($line = fgetcsv($handle, 1000, ",")) !== false) {
//                $formeJuridique = (new FormeJuridique())
//                    ->setStatut($line[0]);
//                $this->manager->persist($formeJuridique);
//            }
//            fclose($handle);
//        }
//        $this->manager->flush();
//        $io->success('Votre commande est un franc succès');
//        return Command::SUCCESS;
//    }
//}
