<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profile_infos', function (Blueprint $table) {
            $table->string('title')->nullable()->after('name');
            $table->text('bio')->nullable()->after('title');
            $table->string('email')->nullable()->after('bio');
            $table->string('phone')->nullable()->after('email');
            $table->string('location')->nullable()->after('phone');
            $table->string('github')->nullable()->after('location');
            $table->string('linkedin')->nullable()->after('github');
            $table->string('twitter')->nullable()->after('linkedin');
            $table->string('website')->nullable()->after('twitter');
            $table->text('skills')->nullable()->after('website');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_infos', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'bio',
                'email',
                'phone',
                'location',
                'github',
                'linkedin',
                'twitter',
                'website',
                'skills'
            ]);
        });
    }
};
