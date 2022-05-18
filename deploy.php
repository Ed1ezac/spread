<?php
namespace Deployer;

require 'recipe/laravel.php';

//Project name
set('application', 'spread-app');

//Project repository
set('repository', 'git@github.com:Ed1ezac/spread.git');
set('branch', 'master');

//[Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false); 
set('ssh_multiplexing', false);
set('keep_releases', 3);

//Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

//Writable dirs by web server 
add('writable_dirs', []);

//Hosts
host('167.99.239.29')
    ->user('deployer')
    ->identityFile('~/.ssh/dep')
    ->forwardAgent(false)
    ->set('deploy_path', '/var/www/html/spread');    
    
//Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});

//[Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

//Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate:fresh');//fresh
after('deploy:symlink', 'artisan:db:seed');