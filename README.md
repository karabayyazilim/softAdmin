![alt text](<https://www.karabayyazilim.com/storage/files/shares/softadmin.png>)

    
## Installation


    git clone https://github.com/karabayyazilim/softAdmin.git

Run the command

    composer install && npm install
    
Configure your .env file

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    
   
    php artisan key:generate

Run the migrations

    php artisan migrate --seed
    
Run the command 

    php artisan storage:link
    
Remove comment line `App\Providers\AppServiceProvider.php` 

    //$data['settingss'] = Settings::all();
        if (isset($data['settingss'])){
            foreach ($data['settingss'] as $key){
                $settingss[$key->setting_key]=$key->setting_value;
            }
            view()->share($settingss);
        }


Your good to go!

Login information

    user name : admin@admin.com
    password : password






