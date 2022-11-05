<?php

namespace App\Command;

use App\Entity\ContactTypes;
use App\Entity\RelationalSituation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MemberAddContactTypeCommand extends Command
{
    protected static $defaultName = 'member:add-contact-type';
    protected static $defaultDescription = 'Agrega tipos de contactos iniciales';

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
            ['Teléfono Móvil', 'mobile_phone', 'text'],
            ['Teléfono Fijo','landline', 'text'],
            ['Correo electrónico','email', 'email'],
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


            $entity = new ContactTypes();

            $entity
                ->setName(trim($datum[0]))
                ->setIdentifier(trim($datum[1]))
                ->setTypeInput(trim($datum[2]))
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
