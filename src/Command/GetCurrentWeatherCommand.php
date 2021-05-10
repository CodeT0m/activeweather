<?php

namespace App\Command;

use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GetCurrentWeatherCommand extends Command
{
    protected static $defaultName = 'get-current-weather';

    protected function configure()
    {
        $this
            ->setDescription('Get the current weather')
            ->setHelp('This command retrieves the current weather')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $client = new Client([
            'base_uri' => 'api.openweathermap.org/data/2.5/',
        ]);

        $response = $client->request('GET', 'weather?q=Arad&appid=400eeadc921bc85d05baffffa5663217&units=metric');

        $io->text($response->getBody());
        $io->success('Response OK');

        return 0;
    }
}
