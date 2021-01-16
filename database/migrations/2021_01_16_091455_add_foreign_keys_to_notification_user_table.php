<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToNotificationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notification_user', function (Blueprint $table) {
            $table->foreign('notification_id')->references('id')->on('notifications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification_user', function (Blueprint $table) {
            $table->dropForeign('notification_user_notification_id_foreign');
            $table->dropForeign('notification_user_user_id_foreign');
        });
    }
}
