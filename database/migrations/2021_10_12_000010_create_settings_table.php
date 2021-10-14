<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    // имя таблицы
    public $tableName = 'settings';

    /**
     * создание таблицы
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->longText('purpose'); // цель кредита и минимальная процентная ставка
            $table->float('salary_rate'); // значение от наличия заработной карты
            $table->text('apartment_cost'); // стоимость жилья
            $table->text('first_payment'); // первоначальный взнос
            $table->text('credit_term'); // срок кредита

            // поля Laravel
            $table->timestamps();
        });

        // комментарий к таблице
        try {
            DB::statement("ALTER TABLE `" . $this->tableName . "` comment 'Начальные установки'");
        } catch (\Exception $e) {
        }

        // ---------------------------------------------------------------
        // вставка первичных данных
        // цель кредита и минимальная процентная ставка
        $purposeArr = json_encode(
            [
                ['name' => 'Готовое жилье', 'min_rate' => 8.1],
                ['name' => 'Новостройка', 'min_rate' => 7.8],
                ['name' => 'Господдержка 2021', 'min_rate' => 6.05],
                ['name' => 'Для семей с детьми', 'min_rate' => 5],
                ['name' => 'Дальневосточная ипотека', 'min_rate' => 0.1],
                ['name' => 'Строительство дома', 'min_rate' => 9.2],
                ['name' => 'Загородный дом, земля', 'min_rate' => 8.4],
                ['name' => 'Рефинансирование', 'min_rate' => 8.2],
                ['name' => 'Наличные под залог жилья', 'min_rate' => 9.2],
                ['name' => 'Военная ипотека', 'min_rate' => 7.5],
                ['name' => 'Машино-место, гараж', 'min_rate' => 9.3],
                ['name' => 'Льготное строительство дома', 'min_rate' => 6]
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        // значение от наличия заработной карты
        $salaryRate = 0.8;
        // стоимость жилья
        $apartmentCost = json_encode([
            'min' => 350000,
            'max' => 10000000,
            'step' => 50000,
        ]);
        // первоначальный взнос
        $firstPayment = json_encode([
            'min' => 50000,
            'max' => 10000000,
        ]);
        // срок кредита
        $creditTerm = json_encode([
            'min' => 1,
            'max' => 30,
        ]);

        DB::statement("INSERT INTO `" . $this->tableName . "` (`id`, `purpose`, `salary_rate`, `apartment_cost`, `first_payment`, `credit_term`) VALUES " .
            "(" .
            "1, '" . $purposeArr . "', " . $salaryRate . ", '" . $apartmentCost . "', '" . $firstPayment . "', '" . $creditTerm . "'" .
            ");");
    }

    /**
     * на случай отката
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
