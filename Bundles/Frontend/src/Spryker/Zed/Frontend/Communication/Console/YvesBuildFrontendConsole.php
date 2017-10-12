<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Frontend\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

/**
 * @method \Spryker\Zed\Storage\Business\StorageFacade getFacade()
 */
class YvesBuildFrontendConsole extends Console
{
    const COMMAND_NAME = 'frontend:yves-build-frontend';
    const DESCRIPTION = 'This command will build Yves frontend.';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription(self::DESCRIPTION);

        parent::configure();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->info('Build Yves frontend');

        $process = new Process('npm run yves', APPLICATION_ROOT_DIR);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        return static::CODE_SUCCESS;
    }
}
