#!/usr/bin/env php
<?php
define( 'WCV_BASE', 'phar://wcvp.phar/' );

// Import components base
require_once WCV_BASE . 'classes/ezc/Base/src/base.php';

// Register component autoloader
spl_autoload_register( 'ezcBase::autoload' );

// Create output class with default verbosity
$output = new ezcConsoleOutput();
$output->options->verbosityLevel = 10;

// Register CLI parameters
$input = new ezcConsoleInput();

$helpOption = $input->registerOption(
    new ezcConsoleOption(
        'h', 'help',
        ezcConsoleInput::TYPE_NONE, false, false,
        'Display this help message.'
    )
);
$helpOption->isHelpOption = true;

$inputOption = $input->registerOption(
    new ezcConsoleOption(
        'i', 'input',
        ezcConsoleInput::TYPE_STRING, false, false,
        'Directory with the WCV content files.'
    )
);
$inputOption->mandatory = true;

$outputOption = $input->registerOption(
    new ezcConsoleOption(
        'o', 'output',
        ezcConsoleInput::TYPE_STRING, false, false,
        'Write the generated files into this directory.'
    )
);
$outputOption->mandatory = true;

$configOption = $input->registerOption(
    new ezcConsoleOption(
        'c', 'config',
        ezcConsoleInput::TYPE_STRING, false, false,
        'Directory with the WCV configuration files.'
    )
);
$configOption->mandatory = true;

$tempOption = $input->registerOption(
    new ezcConsoleOption(
        't', 'temp',
        ezcConsoleInput::TYPE_STRING, false, false,
        'The temporary working directory.'
    )
);

$overrideOption = $input->registerOption(
    new ezcConsoleOption(
        'r', 'override',
        ezcConsoleInput::TYPE_STRING, false, false,
        'Directory with override templates for WCV.'
    )
);

$verboseOption = $input->registerOption(
    new ezcConsoleOption(
        'v', 'verbose',
        ezcConsoleInput::TYPE_NONE, false, false,
        'Extra verbose output.'
    )
);

$quiteOption = $input->registerOption(
    new ezcConsoleOption(
        'q', 'quite',
        ezcConsoleInput::TYPE_NONE, false, false,
        'Silence output.'
    )
);

$sitemapOption = $input->registerOption(
    new ezcConsoleOption(
        's', 'sitemap',
        ezcConsoleInput::TYPE_NONE, false, false,
        'Ping searchengines with updated sitemap.'
    )
);

$pathOption = $input->registerOption(
    new ezcConsoleOption(
        'p', 'path',
        ezcConsoleInput::TYPE_STRING, false, false,
        'Recreate only nodes matching the given path.'
    )
);

$treeOption = $input->registerOption(
    new ezcConsoleOption(
        'n', 'no-tree',
        ezcConsoleInput::TYPE_NONE, false, false,
        'Do not regenerate content tree.'
    )
);

try
{
    $input->process();
}
catch ( ezcConsoleException $e )
{
    $output->outputLine( $e->getMessage(), 'default', 10 );
    exit( 1 );
}

// Display help message?
if ( $helpOption->value )
{
    echo $input->getHelpText( 'WCV - Update content from SVN repository' );
    exit( 0 );
}

//define( 'WCV_HTDOCS', __DIR__ . '/phpmd.org/htdocs/' );
if ( false === file_exists( $outputOption->value ) )
{
    mkdir( $outputOption->value, 0755, true );
}
define( 'WCV_HTDOCS', realpath( $outputOption->value ) . DIRECTORY_SEPARATOR );
define( 'WCV_CONTENT_PATH', realpath( $inputOption->value ) );
define( 'WCV_CONFIG_PATH', realpath( $configOption->value ) . DIRECTORY_SEPARATOR );

if ( $tempOption->value )
{
    define( 'WCV_VAR_PATH', realpath( $tempOption->value ) . DIRECTORY_SEPARATOR );
}
else
{
    define( 'WCV_VAR_PATH', sys_get_temp_dir() . DIRECTORY_SEPARATOR . '~wcv' . DIRECTORY_SEPARATOR );
}

if ( $overrideOption->value )
{
    define( 'WCV_OVERRIDE_BASE', realpath( $overrideOption->value ) . DIRECTORY_SEPARATOR );
}

require WCV_BASE . 'classes/config.php';
require WCV_BASE . 'scripts/updateCacheLogic.php';

__HALT_COMPILER();
