<?php

use App\Models\Post;
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
        Schema::table('user_like_post', function (Blueprint $table) {
            $table->dropColumn('post_id');
            $table->dropTimestamps();

            $table->morphs('likable');
        });

        Schema::rename('user_like_post', 'likables');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('likables', 'user_like_post');

        Schema::table('user_like_post', function (Blueprint $table) {
            $table->dropMorphs('likable');

            $table->foreignIdFor(Post::class);
            $table->timestamps();
        });
    }
};
