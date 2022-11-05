<?php

namespace App\Command;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class BaseProgressBar
{

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param int $percent
     * @return array
     */
    public static function progress_bar(InputInterface $input, OutputInterface $output, int $percent): array
    {
        $io = new SymfonyStyle($input, $output);
        $io->section('Inicio insert');

        $io->section($percent);

        $progressBar = new ProgressBar($output, $percent);

        $progressBar->setBarCharacter('<fg=green>⚬</>');
        $progressBar->setEmptyBarCharacter("<fg=red>⚬</>");
        $progressBar->setProgressCharacter("<fg=green>➤</>");

        $progressBar->setFormat(
            "status\n%current%/%max% [%bar%] %percent:3s%%\n  %estimated:-6s%  %memory:6s%\n"
        );

        return array($io, $progressBar);
    }
}