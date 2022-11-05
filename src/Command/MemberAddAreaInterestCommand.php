<?php

namespace App\Command;

use App\Entity\AreaInterest;
use App\Entity\EnjoyGroup;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MemberAddAreaInterestCommand extends Command
{
    protected static $defaultName = 'member:add-area-interest';
    protected static $defaultDescription = 'Lista inicial de áreas de interés';
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
            ['Relaciones'],
            ['Conocer más la Biblia'],
            ['Descubrir mi propósito'],
            ['Servir'],
            ['Desarrollar hábitos saludables'],
            ['Esparcimiento'],
            ['Diversión'],
            ['Comunión']
        ];

        $percent = count($data);

        list($io, $progressBar) = BaseProgressBar::progress_bar($input, $output, $percent);


        $progressBar->start();
        foreach ($data as $datum) {

            $entity = new AreaInterest();

            $entity
                ->setName(trim($datum[0]))
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
