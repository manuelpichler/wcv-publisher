===============
WCV - Publisher
===============

This project utilizes the http://web-content-viewer.org application
and creates a simple Phar archive from the original source, that can
be used to generate static project websites without the requirement
of complete wcv installation.

Usage
=====

Just clone this project and execute the contained Ant build file. ::

  ~ $ git clone git://github.com/manuelpichler/wcv-publisher.git
  ~ $ cd wcv-publisher
  ~ $ ant

When Ant has finished you will find an executable Phar archive in the
newly created ``dist/`` directory. ::

  ~ $ cd dist
  ~ $ ./wcvp.phar --help
  Usage: $ ./wcvp.phar [-h ] -i "" -o "" -c "" [-t ""] [-r ""]...
  WCV - Update content from SVN repository

  -h / --help      Display this help message.
  -i / --input     Directory with the WCV content files.
  -o / --output    Write the generated files into this directory.
  -c / --config    Directory with the WCV configuration files.
  -t / --temp      The temporary working directory.
  -r / --override  Directory with override templates for WCV.
  -v / --verbose   Extra verbose output.
  -q / --quite     Silence output.
  -s / --sitemap   Ping searchengines with updated sitemap.
  -p / --path      Recreate only nodes matching the given path.
  -n / --no-tree   Do not regenerate content tree.

