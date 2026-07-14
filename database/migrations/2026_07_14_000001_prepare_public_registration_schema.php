<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('tenants')) {
            Schema::create('tenants', function (Blueprint $table): void {
                $table->id();
                $table->string('company_name');
                $table->string('slug')->unique();
                $table->string('currency', 8)->default('UGX');
                $table->date('fiscal_year_start')->nullable();
                $table->string('status', 40)->default('trial');
                $table->timestamps();
            });
        }

        Schema::table('users', function (Blueprint $table): void {
            if (! Schema::hasColumn('users', 'tenant_id')) {
                $table->foreignId('tenant_id')->nullable()->after('id')->index();
            }

            if (! Schema::hasColumn('users', 'role')) {
                $table->string('role', 50)->default('user')->after('password');
            }

            if (! Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('role');
            }
        });
    }

    public function down(): void
    {
        // Non-destructive: these tables/columns may belong to the imported legacy ERP schema.
    }
};
