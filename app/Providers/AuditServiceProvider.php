<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;
use function Clue\StreamFilter\fun;

class AuditServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blueprint::macro('audits', function (){
            $this->unsignedInteger('Created_By')->nullable();
            $this->unsignedInteger('Modified_By')->nullable();
            $this->unsignedInteger('Deleted_By')->nullable();
            $this->boolean('Nav_Synced')->default(false);
            $this->boolean('Web_Synced')->default(false);
            $this->boolean('Delete_Synced')->default(false);
            $this->dateTime('Last_Synced_Timestamp')->nullable();
        });
    }
}
