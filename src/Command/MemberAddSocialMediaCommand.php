<?php

namespace App\Command;

use App\Entity\SocialMedia;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MemberAddSocialMediaCommand extends Command
{
    protected static $defaultName = 'member:add-social-media';
    protected static $defaultDescription = 'Listado inicial de Redes Sociales';

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
            ['YouVersion', 'you_version','https://my.bible.com' ],
            ['Instagram','instagram', 'https://www.instagram.com'],
            ['TikTok','tiktok', 'https://www.tiktok.com'],
            ['Telegram','telegram', ''],
            ['Facebook','facebook', 'https://www.facebook.com/'],
            ['WhatsApp','whatsapp', ''],
            ['Messenger','messenger', 'https://www.messenger.com'],
            ['Twitter','twitter', 'https://twitter.com'],
            ['Discord','discord', 'https://discord.com'],
            ['LinkedIn','linkedin', 'https://www.linkedin.com'],
            ['Slack','slack', 'https://slack.com'],
            ['Twitch','twitch', 'https://www.twitch.tv'],
            ['Spotify','spotify', 'https://www.spotify.com/ar'],
            ['YouTube','youtube', 'https://www.youtube.com'],

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


            $entity = new SocialMedia();

            $entity
                ->setName(trim($datum[0]))
                ->setIdentifier(trim($datum[1]))
                ->setWebSite(trim($datum[2]))
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
