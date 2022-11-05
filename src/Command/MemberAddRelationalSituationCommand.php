<?php

namespace App\Command;

use App\Entity\RelationalSituation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MemberAddRelationalSituationCommand extends Command
{
    protected static $defaultName = 'member:add-relational-situation';
    protected static $defaultDescription = 'Agrega situaciones relacionales iniciales';

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct(null);
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
            ['Soltero', 'single'],
            ['En pareja','couple'],
            ['Casado','married'],
            ['Viudo/a','widower'],
            ['Divorciado/a','divorced'],
        ];
        $io = new SymfonyStyle($input, $output);
        $io->section('Inicio insert');

        $percent = count($data);

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


            $entity = new RelationalSituation();

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
