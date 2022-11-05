<?php

namespace App\Command;

use App\Entity\Needs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MemberAddNeedsCommand extends Command
{
    protected static $defaultName = 'member:add-needs';
    protected static $defaultDescription = 'Lista de problemas o necesidades de los miembros de la iglesia';

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
            ['Problema de salud'],
            ['Economía'],
            ['Familia'],
            ['Oración'],
            ['Adicciones'],
            ['Equilibrio emocional'],
            ['Control de emociones'],
            ['Soledad'],
            ['Crianza'],
            ['Matrimonial'],
            ['Laboral'],
            ['Legal'],
            ['Identidad sexual']
        ];

        $percent = count($data);

        list($io, $progressBar) = BaseProgressBar::progress_bar($input, $output, $percent);


        $progressBar->start();
        foreach ($data as $datum) {

            $entity = new Needs();

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
