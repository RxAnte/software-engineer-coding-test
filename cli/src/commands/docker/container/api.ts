import { Command } from '@oclif/core';
import { execSync } from 'node:child_process';
import chalk from 'chalk';

export default class Api extends Command {
    // Allow variable arguments
    public static strict = false;

    public static summary = `Execute command in the ${chalk.cyan('api')} container. Empty argument starts a shell session`;

    public static description = 'If this command is run without arguments, a shell session will be started in the api container and you will be placed in that shell session. However, any arguments provided will, instead, be passed into and run in the shell session and then the session will exit. The latter is most often how you will use this command.';

    public static args = [
        {
            name: 'cmd',
            description: 'command',
            default: null,
        },
    ];

    public async run (): Promise<void> {
        this.log(chalk.yellow(
            "You're working inside the 'api' application container of this project.",
        ));

        if (this.argv.length) {
            execSync(
                `docker exec -it software-engineering-codeing-test_api sh -c "${this.argv.join(' ')}";`,
                { stdio: 'inherit' },
            );

            return;
        }

        this.log(chalk.yellow("Remember to exit when you're done"));

        execSync(
            'docker exec -it software-engineering-codeing-test_api bash;',
            { stdio: 'inherit' },
        );
    }
}
