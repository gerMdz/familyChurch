<?php

namespace App\Command;

use App\Entity\ChurchExperiences;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MemberAddChurchExperiencesCommand extends Command
{
    protected static $defaultName = 'member:add-church-experiences';
    protected static $defaultDescription = 'Agrega lista inicial de experiencias en la iglesia';

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
            ['Curso: Nuevo Inicio con Dios','Curso: Nuevo Inicio con Dios','nuevo_inicio_con_dios'],
            ['Bautismo','Bautismo','bautismo'],
            ['Paso 1 - Avance - Charla de nuevos Miembros','Paso 1 - Avance - Charla de nuevos Miembros','avance_1'],
            ['Paso 2 - Avance - Descubre tu Forma','Paso 2 - Avance - Descubre tu Forma','avance_2'],
            ['Paso 3 - Avance - Adopta Hábitos de Madurez','Paso 3 - Avance - Adopta Hábitos de Madurez','avance_3'],
            ['Paso 4 - Avance - Voluntariado inicial por un mes','Paso 4 - Avance - Voluntariado inicial por un mes','avance_4'],
            ['Vida Discipular 1','Vida Discipular 1','discipular_1'],
            ['Vida Discipular 2','Vida Discipular 2','discipular_2'],
            ['Vida Discipular 3','Vida Discipular 3','discipular_3'],
            ['Sea Libre','Sea Libre','sea_libre'],
            ['Fundamentos','Fundamentos','fundamentos'],
            ['Celebremos la Recuperación','Celebremos la Recuperación','celebremos'],
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
            $entity = new ChurchExperiences();

            $entity
                ->setName(trim($datum[0]))
                ->setDescription(trim($datum[1]))
                ->setIdentifier(trim($datum[2]))
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
