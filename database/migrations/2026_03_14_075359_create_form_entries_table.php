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
        Schema::create('form_entries', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('checked_unit')->nullable();
            $table->string('years_of_review')->nullable();
            $table->string('found')->nullable();
            $table->string('order')->nullable();

            $table->string('excellent_goods')->nullable();
            $table->string('remaining_items')->nullable();

            $table->text('guidance_corrective_and_advisory')->nullable();
            $table->string('disciplinary')->nullable();

            $table->decimal('refund_amount', 15, 2)->nullable();
            $table->string('achieved')->nullable();
            $table->string('remaining')->nullable();

            $table->string('follow_up_letter_number_1')->nullable();
            $table->string('follow_up_letter_number_2')->nullable();
            $table->string('follow_up_letter_number_3')->nullable();

            $table->string('written_confirmation_number_of_compliance')->nullable();
            
            $table->enum('done_not_done', ['done', 'not done'])->nullable();

            $table->text('reason_for_non_compliance')->nullable();
            $table->string('responsible_department')->nullable();

            $table->text('considerations')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_entries');
    }
};