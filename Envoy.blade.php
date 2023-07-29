@servers(['web' => 'n1568911@mr-family.com -p 65002'])

@task('deploy', ['on' => 'web'])
    cd www/mrfamily
    git pull 
    php artisan optimize
@endtask
