<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'discount.maffinca.design');

// Project repository
set('repository', 'git@github.com:maffinca69/Discount-Backend.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts

host('193.109.78.189')
    ->user('deployer')
    ->set('deploy_path', '/var/www/{{application}}');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
