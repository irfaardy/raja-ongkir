# Travis CI Configuration File

# Tell Travis CI we're using PHP
language: php

# Build matrix options
matrix:
  include:
    - php: 5.5
      env: WP_TRAVISCI=travis:js
    - php: 5.2
      env: WP_TRAVISCI=travis:phpunit
    - php: 5.3
      env: WP_TRAVISCI=travis:phpunit
    - php: 5.4
      env: WP_TRAVISCI=travis:phpunit
    - php: 5.5
      env: WP_TRAVISCI=travis:phpunit
    - php: 5.6
      env: WP_TRAVISCI=travis:phpunit
    - php: hhvm
      env: WP_TRAVISCI=travis:phpunit
  allow_failures:
    - php: 5.6
    - php: hhvm
  fast_finish: true

env:
  - WP_VERSION=master WP_MULTISITE=1

# Before install, failures in this section will result in build status 'errored'
before_install:
  - WP_CORE_DIR=/tmp/wordpress/
  - >
    if [[ "$WP_TRAVISCI" == "travis:phpunit" ]]; then
        mysql -e "CREATE DATABASE wordpress_tests;" -uroot
        cp wp-tests-config-sample.php wp-tests-config.php
        sed -i "s/pdb/wordpress_tests/" wp-tests-config.php
        sed -i "s/pdbuser/travis/" wp-tests-config.php
        sed -i "s/04-3J31cd08k5B//" wp-tests-config.php
        svn checkout https://plugins.svn.wordpress.org/wordpress-importer/trunk tests/phpunit/data/plugins/wordpress-importer
    fi

# Script, failures in this section will result in build status 'failed'
script: ./civic.sh