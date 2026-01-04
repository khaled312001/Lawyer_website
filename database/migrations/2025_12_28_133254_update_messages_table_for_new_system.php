<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, truncate messages table to avoid foreign key issues
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('messages')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create conversations table
        if (!Schema::hasTable('conversations')) {
            Schema::create('conversations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id'); // العميل
                $table->unsignedBigInteger('lawyer_id'); // المحامي
                $table->string('subject')->nullable(); // موضوع المحادثة
                $table->boolean('is_active')->default(true); // نشط أم مغلق
                $table->timestamp('last_message_at')->nullable(); // آخر رسالة
                $table->timestamps();
                
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('lawyer_id')->references('id')->on('lawyers')->onDelete('cascade');
                
                // منع تكرار المحادثة بين نفس العميل والمحامي
                $table->unique(['user_id', 'lawyer_id']);
            });
        }

        // Update messages table
        Schema::table('messages', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['lawyer_view', 'user_view', 'send_lawyer', 'send_user']);
            
            // Drop old foreign keys if they exist
            $table->dropColumn(['lawyer_id', 'user_id']);
            
            // Add new columns
            $table->unsignedBigInteger('conversation_id')->after('id');
            $table->string('sender_type')->after('conversation_id'); // App\Models\User, Modules\Lawyer\app\Models\Lawyer, App\Models\Admin
            $table->unsignedBigInteger('sender_id')->after('sender_type');
            $table->string('attachment')->nullable()->after('message');
            $table->boolean('is_read')->default(false)->after('attachment');
            $table->timestamp('read_at')->nullable()->after('is_read');
            
            // Add foreign key
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            
            // Add indexes
            $table->index(['conversation_id', 'created_at']);
            $table->index(['sender_type', 'sender_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['conversation_id']);
            $table->dropColumn(['conversation_id', 'sender_type', 'sender_id', 'attachment', 'is_read', 'read_at']);
            
            // Restore old columns
            $table->unsignedBigInteger('lawyer_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('lawyer_view')->default(false);
            $table->boolean('user_view')->default(false);
            $table->boolean('send_lawyer')->default(false);
            $table->boolean('send_user')->default(false);
        });
        
        Schema::dropIfExists('conversations');
    }
};
