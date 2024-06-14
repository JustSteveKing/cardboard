<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\{error, info, progress, suggest};
use Laravel\Sanctum\NewAccessToken;
use Symfony\Component\Console\Attribute\AsCommand;

use Symfony\Component\Console\Command\Command as SymfonyCommand;

#[AsCommand(name: 'dev:setup', description: 'Set up the development environment.')]
final class SetUpDevelopmentEnvironment extends Command
{
    public function handle(): int
    {
        if (app()->isProduction()) {
            error(
                message: 'This command can only be run in a development environment.'
            );

            return SymfonyCommand::FAILURE;
        }

        info(
            message: 'Setting up development environment...',
        );

        info(
            message: 'Clearing cache ...',
        );

        $this->call(
            command: 'optimize:clear',
        );

        info(
            message: 'Migrating and seeding database...',
        );

        $this->call(
            command: 'migrate:fresh',
            arguments: [
                '--force' => true,
                '--seed' => true,
            ]
        );

        $name = suggest(
            label: 'What is your name?',
            options: ['Taylor', 'Dayle'],
            placeholder: 'Your name',
            default: 'Developer Account',
        );

        $email = suggest(
            label: 'What is your email?',
            options: ['test@example.com', 'taylor@laravel.com'],
            placeholder: 'Your email address',
            default: config('development.email'),
        );

        info(
            message: 'Creating your user account ...',
        );

        /** @var User $user */
        $user = User::query()->create(
            attributes: [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );

        info(
            message: 'Creating your API Token ...',
        );

        $token = $user->createToken(
            name: 'development',
        );

        info(
            message: "Your access token is {$token->plainTextToken}",
        );

        return SymfonyCommand::SUCCESS;
    }
}
