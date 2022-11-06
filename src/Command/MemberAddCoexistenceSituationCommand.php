<?php

namespace App\Command;

use App\Entity\CoexistenceSituation;
use App\Entity\Needs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MemberAddCoexistenceSituationCommand extends Command
{
    protected static $defaultName = 'member:add-coexistence_situation';
    protected static $defaultDescription = 'List inicial de tipo de familiares';

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct();
        $this->manager = $manager;

    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $data = [
            ['Papá', 'father'],
            ['Mamá', 'mother'],
            ['Tío/a', 'uncle'],
            ['Abuelo/a', 'grandparent'],
            ['Cónyuge', 'spouse'],
            ['Hijo/s', 'sons'],
            ['Solo/a', 'single'],
        ];

        $percent = count($data);

        list($io, $progressBar) = BaseProgressBar::progress_bar($input, $output, $percent);


        $progressBar->start();
        foreach ($data as $datum) {

            $entity = new CoexistenceSituation();

            $entity
                ->setName(trim($datum[0]))
                ->setIdentifier(trim($datum[1]))
            ;

            $this->manager->persist($entity);

            $progressBar->advance();

        }
        $this->manager->flush();

        $progressBar->finish();

        $io->success('Ok en la base.');

        return Command::SUCCESS;
    }

}
