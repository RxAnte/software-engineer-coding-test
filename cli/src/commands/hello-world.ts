import { Command } from '@oclif/core';
import chalk from 'chalk';

export default class extends Command {
    public static summary = 'Set up git for standard development';

    public async run (): Promise<void> {
        this.log(chalk.cyan('Hello World'));
    }
}
