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
        if (Schema::hasTable('conversations')) {
            // Check if table already has polymorphic columns
            if (!Schema::hasColumn('conversations', 'sender_id')) {
                // Migrate existing data if user_id and lawyer_id exist
                if (Schema::hasColumn('conversations', 'user_id') && Schema::hasColumn('conversations', 'lawyer_id')) {
                    // Migrate existing conversations to polymorphic format
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    
                    // Add new polymorphic columns
                    Schema::table('conversations', function (Blueprint $table) {
                        $table->unsignedBigInteger('sender_id')->nullable()->after('id');
                        $table->string('sender_type')->nullable()->after('sender_id');
                        $table->unsignedBigInteger('receiver_id')->nullable()->after('sender_type');
                        $table->string('receiver_type')->nullable()->after('receiver_id');
                    });
                    
                    // Migrate existing data: user is sender, lawyer is receiver
                    DB::table('conversations')->get()->each(function ($conversation) {
                        DB::table('conversations')
                            ->where('id', $conversation->id)
                            ->update([
                                'sender_id' => $conversation->user_id,
                                'sender_type' => 'App\Models\User',
                                'receiver_id' => $conversation->lawyer_id,
                                'receiver_type' => 'Modules\Lawyer\app\Models\Lawyer',
                            ]);
                    });
                    
                    // Make new columns not nullable
                    Schema::table('conversations', function (Blueprint $table) {
                        $table->unsignedBigInteger('sender_id')->nullable(false)->change();
                        $table->string('sender_type')->nullable(false)->change();
                        $table->unsignedBigInteger('receiver_id')->nullable(false)->change();
                        $table->string('receiver_type')->nullable(false)->change();
                    });
                    
                    // Drop old columns and constraints
                    Schema::table('conversations', function (Blueprint $table) {
                        // Drop unique constraint if it exists
                        try {
                            $table->dropUnique(['user_id', 'lawyer_id']);
                        } catch (\Exception $e) {
                            // Constraint might not exist, continue
                        }
                        
                        // Drop foreign keys if they exist
                        try {
                            $table->dropForeign(['user_id']);
                        } catch (\Exception $e) {
                            // Foreign key might not exist, continue
                        }
                        
                        try {
                            $table->dropForeign(['lawyer_id']);
                        } catch (\Exception $e) {
                            // Foreign key might not exist, continue
                        }
                        
                        // Drop columns if they exist
                        $columnsToDrop = [];
                        if (Schema::hasColumn('conversations', 'user_id')) {
                            $columnsToDrop[] = 'user_id';
                        }
                        if (Schema::hasColumn('conversations', 'lawyer_id')) {
                            $columnsToDrop[] = 'lawyer_id';
                        }
                        if (Schema::hasColumn('conversations', 'subject')) {
                            $columnsToDrop[] = 'subject';
                        }
                        if (Schema::hasColumn('conversations', 'is_active')) {
                            $columnsToDrop[] = 'is_active';
                        }
                        
                        if (!empty($columnsToDrop)) {
                            $table->dropColumn($columnsToDrop);
                        }
                    });
                    
                    // Add indexes for polymorphic relationships
                    Schema::table('conversations', function (Blueprint $table) {
                        $table->index(['sender_type', 'sender_id']);
                        $table->index(['receiver_type', 'receiver_id']);
                        $table->index(['sender_type', 'sender_id', 'receiver_type', 'receiver_id'], 'conversation_participants_index');
                    });
                    
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                } else {
                    // Table exists but doesn't have old columns, just add polymorphic columns
                    Schema::table('conversations', function (Blueprint $table) {
                        if (!Schema::hasColumn('conversations', 'sender_id')) {
                            $table->unsignedBigInteger('sender_id')->after('id');
                            $table->string('sender_type')->after('sender_id');
                            $table->unsignedBigInteger('receiver_id')->after('sender_type');
                            $table->string('receiver_type')->after('receiver_id');
                            $table->index(['sender_type', 'sender_id']);
                            $table->index(['receiver_type', 'receiver_id']);
                        }
                    });
                }
            }
            
            // Ensure last_message_at column exists
            if (!Schema::hasColumn('conversations', 'last_message_at')) {
                Schema::table('conversations', function (Blueprint $table) {
                    $table->timestamp('last_message_at')->nullable()->after('receiver_type');
                });
            }
            
            // Ensure status column exists
            if (!Schema::hasColumn('conversations', 'status')) {
                Schema::table('conversations', function (Blueprint $table) {
                    $table->string('status')->default('active')->after('last_message_at');
                });
            }
        } else {
            // Create table with polymorphic structure
            Schema::create('conversations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('sender_id');
                $table->string('sender_type');
                $table->unsignedBigInteger('receiver_id');
                $table->string('receiver_type');
                $table->unsignedBigInteger('last_message_id')->nullable();
                $table->timestamp('last_message_at')->nullable();
                $table->string('status')->default('active');
                $table->timestamps();
                
                $table->index(['sender_type', 'sender_id']);
                $table->index(['receiver_type', 'receiver_id']);
                $table->index(['sender_type', 'sender_id', 'receiver_type', 'receiver_id'], 'conversation_participants_index');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is designed to be one-way
        // Reverting would require data migration which could be lossy
        // If you need to revert, create a separate migration
    }
};
