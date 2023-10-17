import { Command } from '@oclif/core';
import { execSync } from 'node:child_process';
import * as fs from 'fs-extra';
import chalk from 'chalk';

export default class Down extends Command {
    public async run (): Promise<void> {
        const rootDir = fs.realpathSync(`${this.config.root}/../`);
        const dockerDir = `${rootDir}/docker`;

        this.log(chalk.cyan('Stopping the Docker environment…'));

        execSync(
            `
                cd ${dockerDir};
                docker compose -f docker-compose.yml -p software-engineering-codeing-test down;
            `,
            { stdio: 'inherit' },
        );

        this.log(chalk.green('Docker environment is offline.'));
    }
}
