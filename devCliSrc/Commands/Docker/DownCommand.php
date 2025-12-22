<?php

declare(strict_types=1);

namespace Cli\Commands\Docker;

use Cli\CliSrcPath;
use Cli\StreamCommand;
use RxAnte\AppBootstrap\Cli\ApplyCliCommandsEvent;
use Symfony\Component\Console\Output\ConsoleOutputInterface;

readonly class DownCommand
{
    public static function applyCommand(ApplyCliCommandsEvent $commands): void
    {
        $commands->addCommand('docker:down', self::class)
            ->descriptions('Stops the Docker environment');
    }

    public function __construct(
        private CliSrcPath $cliSrcPath,
        private StreamCommand $streamCommand,
        private ConsoleOutputInterface $output,
    ) {
    }

    public function __invoke(): void
    {
        $this->run();
    }

    public function run(): void
    {
        $this->output->writeln(
            '<fg=cyan>Stopping the Docker environment…</>',
        );

        $this->streamCommand->stream(
            [
                'docker',
                'compose',
                '-f',
                'docker-compose.yml',
                '-p',
                'software-engineering-coding-test',
                'down',
            ],
            $this->cliSrcPath->dockerPath(),
        );

        $this->output->writeln(
            '<fg=green>Docker environment is offline.</>',
        );
    }
}
