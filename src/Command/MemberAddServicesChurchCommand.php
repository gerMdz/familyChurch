<?php

namespace App\Command;

use App\Entity\ServicesChurch;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MemberAddServicesChurchCommand extends Command
{
    protected static $defaultName = 'member:add-services-church';
    protected static $defaultDescription = 'Lista inicial de servicios de la iglesia';

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
            ['Cafetería', 'cafeteria'],
            ['Camping', 'camping'],
            ['Escuela de Música', 'music_school'],
            ['Escuela de Danza', 'dance_school'],
            ['Casa de la Mujer', 'women_s_house'],
            ['Jardín Maternal', 'maternal_garden'],
            ['A.C.A.S.A.', 'acasa'],
        ];

        $percent = count($data);

        $io = new SymfonyStyle($input, $output);
        $io->section('Inicio insert');

        $io->section($percent);

        $progressBar = new ProgressBar($output, count($data));

        $progressBar->setBarCharacter('<fg=green>⚬</>');
        $progressBar->setEmptyBarCharacter("<fg=red>⚬</>");
        $progressBar->setProgressCharacter("<fg=green>➤</>");

        $progressBar->setFormat(
            "status\n%current%/%max% [%bar%] %percent:3s%%\n  %estimated:-6s%  %memory:6s%\n"
        );

// starts and displays the progress bar
        $progressBar->start();
        foreach ($data as $datum) {

            $entity = new ServicesChurch();

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
