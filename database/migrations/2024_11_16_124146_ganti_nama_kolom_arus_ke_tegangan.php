<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE `pju` CHANGE `arus` `tegangan` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_2` CHANGE `arus` `tegangan` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_3` CHANGE `arus` `tegangan` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_4` CHANGE `arus` `tegangan` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_5` CHANGE `arus` `tegangan` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_6` CHANGE `arus` `tegangan` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_7` CHANGE `arus` `tegangan` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_8` CHANGE `arus` `tegangan` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_9` CHANGE `arus` `tegangan` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_10` CHANGE `arus` `tegangan` VARCHAR(255)');
    }
    
    public function down()
    {
        DB::statement('ALTER TABLE `pju` CHANGE `tegangan` `arus` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_2` CHANGE `tegangan` `arus` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_3` CHANGE `tegangan` `arus` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_4` CHANGE `tegangan` `arus` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_5` CHANGE `tegangan` `arus` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_6` CHANGE `tegangan` `arus` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_7` CHANGE `tegangan` `arus` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_8` CHANGE `tegangan` `arus` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_9` CHANGE `tegangan` `arus` VARCHAR(255)');
        DB::statement('ALTER TABLE `pju_10` CHANGE `tegangan` `arus` VARCHAR(255)');
    }
    
};
