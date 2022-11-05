<?php

namespace App\Command;

use App\Entity\EnjoyGroup;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MemberAddEnjoyGroupCommand extends Command
{
    protected static $defaultName = 'member:add-enjoy-group';
    protected static $defaultDescription = 'Lista inicial de enjoy group';

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
            ['Compañía'],
            ['Amistad'],
            ['Comida'],
            ['Oración'],
            ['Aprender de la palabra']
        ];

        $percent = count($data);

        list($io, $progressBar) = BaseProgressBar::progress_bar($input, $output, $percent);


        $progressBar->start();
        foreach ($data as $datum) {

            $entity = new EnjoyGroup();

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
