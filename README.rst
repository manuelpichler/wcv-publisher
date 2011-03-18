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
newly created ``dist/`` directory.
