<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Stancl\Tenancy\Database\Models\Domain;
use Stancl\Tenancy\Database\Models\Tenant;

class CreateTenant extends Command
{
    protected $signature = 'tenant:create {user_id} {domain}';
    protected $description = 'Create a tenant with a custom domain';

    public function handle()
    {
        $user = User::find($this->argument('user_id'));

        if (!$user) {
            $this->error('User not found.');
            return;
        }

        $tenant = Tenant::create([
            'id' => $user->id,
        ]);

        $tenant->domains()->create([
            'domain' => $this->argument('domain'),
        ]);

        $this->info('Tenant created successfully!');
    }
}
