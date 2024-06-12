<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class SetUpDevelopmentEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the development environment';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (app()->isProduction()) {
            $this->error('This command can only be run in a development environment.');

            return;
        }

        $this->info('Setting up development environment...');

        $this->info('Clearing cache...');
        Artisan::call('optimize:clear');

        $this->info('Migrating database...');
        Artisan::call('migrate:fresh --force');

        $this->info('Seeding database...');
        Artisan::call('db:seed --force');

        $user = User::factory()
            ->create([
                'name' => 'Developer Account',
                'email' => config('development.email'),
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

        $token = $user->createToken('development');

        $this->info("Your access token is {$token->plainTextToken}");

    }
}
