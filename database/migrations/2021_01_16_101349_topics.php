<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Topics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_unicode_ci';
            // CONTENT
            $table->char('id', 36)->nullable(false)->comment('');
			$table->char('author_id', 36)->nullable(false)->comment('');
			$table->string('name', 100)->nullable(false)->comment('');
			$table->string('desciption', 2000)->nullable(false)->comment('');
			$table->timestamp('created_at')->comment('');
			$table->timestamp('updated_at')->comment('');
			$table->timestamp('deleted_at')->comment('');
			$table->primary('id');
			$table->index('author_id', 'topics_author_id_foreign');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
