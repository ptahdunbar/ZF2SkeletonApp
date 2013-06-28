ZF2 Skeleton App
================

Introduction
------------
This is a mirror of the Zend Framework 2 skeleton application
with a few opinionated tweaks that I frequently use for my projects.

Feel free to fork it or contribute PRs, I'm all ears :)

Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies using the `create-project` command:

    Clone the repository and manually invoke `composer` using the shipped
`composer.phar`:

    cd my/project/dir
    git clone git://github.com/ptahdunbar/ZF2SkeletonApp.git
    cd ZF2SkeletonApp
    php composer.phar self-update
    php composer.phar install

(The `self-update` directive is to ensure you have an up-to-date `composer.phar`
available.)

Another alternative for downloading the project is to grab it via `curl`, and
then pass it to `tar`:

    cd my/project/dir
    curl -#L https://github.com/ptahdunbar/ZF2SkeletonApp/tarball/master | tar xz --strip-components=1

You would then invoke `composer` to install dependencies per the previous
example.

Virtual Host
------------
Afterwards, set up a virtual host to point to the public/ directory of the
project and you should be ready to go!