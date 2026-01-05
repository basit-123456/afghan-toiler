<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('email');
            $table->string('tailor_name')->after('password');
            $table->decimal('tailor_pricing', 10, 2)->after('tailor_name');
            $table->decimal('waskat_tailor_pricing', 10, 2)->after('tailor_pricing');
            $table->decimal('kurit_tailor_pricing', 10, 2)->after('waskat_tailor_pricing');
            $table->decimal('patloon_tailor_pricing', 10, 2)->after('kurit_tailor_pricing');
            $table->text('full_address')->nullable()->after('patloon_tailor_pricing');
            $table->string('logo')->nullable()->after('full_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone_number',
                'tailor_name',
                'tailor_pricing',
                'waskat_tailor_pricing',
                'kurit_tailor_pricing',
                'patloon_tailor_pricing',
                'full_address',
                'logo'
            ]);
        });
    }
};
