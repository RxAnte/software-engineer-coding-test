import { Command, Flags } from '@oclif/core';
import { execSync } from 'node:child_process';
import * as fs from 'fs-extra';
import chalk from 'chalk';
import Build from './build';

export default class Up extends Command {
    public static flags = {
        'skip-provision': Flags.boolean({
            char: 's',
            default: false,
        }),
    };

    public async run (): Promise<void> {
        const { flags } = await this.parse(Up);

        const rootDir = fs.realpathSync(`${this.config.root}/../`);
        const dockerDir = `${rootDir}/docker`;
        const ephemeralStorageDir = `${dockerDir}/_ephemeral-storage`;
        const hasBuiltFile = `${ephemeralStorageDir}/has_built`;

        const hasBuilt = fs.existsSync(hasBuiltFile);

        if (!hasBuilt) {
            this.log(chalk.cyan('Building Docker images…'));

            const BuildC = new Build([], this.config);
            await BuildC.run();

            this.log(chalk.green('Docker images were built.'));

            fs.writeFileSync(hasBuiltFile, '');
        }

        if (!flags['skip-provision']) {
            this.log(chalk.cyan('Running web provisioning…'));

            execSync(
                `
                    cd ${dockerDir};

                    chmod +x api/pre-up-provisioning.sh;
                    api/pre-up-provisioning.sh;

                    chmod +x web/pre-up-provisioning.sh;
                    web/pre-up-provisioning.sh;
                `,
                { stdio: 'inherit' },
            );

            this.log(chalk.green('Web provisioning finished.'));
        }

        this.log(chalk.cyan('Bringing the Docker environment online…'));

        execSync(
            `
                cd ${dockerDir};
                docker compose -f docker-compose.yml -p software-engineering-codeing-test up -d;
            `,
            { stdio: 'inherit' },
        );

        this.log(chalk.green('Docker environment is online.'));
    }
}
