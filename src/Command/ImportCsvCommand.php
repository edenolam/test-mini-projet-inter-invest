<?php

namespace App\Command;

use App\Entity\FormeJuridique;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCsvCommand extends Command
{
    protected static $defaultName = 'app:import-csv';

    private string $csv; // La route du fichier csv est importée grâce au fichier services.yaml

    private EntityManagerInterface $manager;

    /**
     * ImportCommand constructor.
     * @param string $csv
     * @param EntityManagerInterface $manager
     */
    public function __construct(string $csv, EntityManagerInterface $manager)
    {
        parent::__construct(self::$defaultName);
        $this->csv = $csv;
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this->setDescription('Import de forme juridique à partir d\'un fichier csv');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if (($handle = fopen($this->csv, "r")) !== false) {
            while (($line = fgetcsv($handle, 1000, ",")) !== false) {
                $formeJuridique = (new FormeJuridique())
                    ->setStatut($line[0]);
                $this->manager->persist($formeJuridique);
            }
            fclose($handle);
        }
        $this->manager->flush();
        $io->success('csv forme juridique importé');
        return Command::SUCCESS;
    }
}
