<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote', function (Blueprint $table) {
            $table->id();
            $table->string('symbol'); //: "BAC",
            $table->string('companyName')->nullable(); //: "Bank Of America Corp.",
            $table->string('primaryExchange')->nullable(); //: "NEW YORK STOCK EXCHANGE, INC.",
            $table->string('calculationPrice')->nullable(); //: "close",
            $table->decimal('open', 8, 2)->nullable(); //: 28.81,
            $table->bigInteger('openTime')->nullable(); //: 1607437801023,
            $table->string('openSource')->nullable(); //: "official",
            $table->decimal('close', 8, 2)->nullable(); //: 28.81,
            $table->bigInteger('closeTime', 0)->nullable(); //: 1607461201852,
            $table->string('closeSource')->nullable(); //: "official",
            $table->decimal('high', 8, 2)->nullable(); //: 29.12,
            $table->bigInteger('highTime')->nullable(); //: 1607461198592,
            $table->string('highSource')->nullable(); //: "15 minute delayed price",
            $table->decimal('low', 8, 2)->nullable(); //: 27.68,
            $table->bigInteger('lowTime')->nullable(); //: 1607437803011,
            $table->string('lowSource')->nullable(); //: "15 minute delayed price",
            $table->decimal('latestPrice', 8, 2)->nullable(); //: 28.81,
            $table->string('latestSource')->nullable(); //: "Close",
            $table->string('latestTime')->nullable(); //: "December 8, 2020",
            $table->bigInteger('latestUpdate')->nullable(); //: 1607461201852,
            $table->bigInteger('latestVolume')->nullable(); //: 33820759,
            $table->decimal('iexRealtimePrice', 8, 2)->nullable(); //: 28.815,
            $table->integer('iexRealtimeSize')->nullable(); //: 100,
            $table->bigInteger('iexLastUpdated')->nullable(); //: 1607461192396,
            $table->decimal('delayedPrice', 8, 2)->nullable(); //: 28.82,
            $table->bigInteger('delayedPriceTime')->nullable(); //: 1607461198592,
            $table->decimal('oddLotDelayedPrice', 8, 2)->nullable(); //: 28.82,
            $table->bigInteger('oddLotDelayedPriceTime')->nullable(); //: 1607461198391,
            $table->decimal('extendedPrice', 8, 2)->nullable(); //: 28.93,
            $table->decimal('extendedChange', 8, 2)->nullable(); //: 0.04,
            $table->decimal('extendedChangePercent', 8, 2)->nullable(); //: 0.00137,
            $table->bigInteger('extendedPriceTime')->nullable(); //: 1607471631362,
            $table->decimal('previousClose', 8, 2)->nullable(); //: 29.49,
            $table->bigInteger('previousVolume')->nullable(); //: 42197768,
            $table->float('change', 8, 2)->nullable(); //: -0.16,
            $table->float('changePercent', 8, 2)->nullable(); //: -0.0045,
            $table->bigInteger('volume')->nullable(); //: 33820759,
            $table->decimal('iexMarketPercent', 10, 10)->nullable(); //: 0.01709376134658947,
            $table->bigInteger('iexVolume')->nullable(); //: 578127,
            $table->bigInteger('avgTotalVolume')->nullable(); //: 60029202,
            $table->integer('iexBidPrice')->nullable(); //: 0,
            $table->integer('iexBidSize')->nullable(); //: 0,
            $table->integer('iexAskPrice')->nullable(); //: 0,
            $table->integer('iexAskSize')->nullable(); //: 0,
            $table->decimal('iexOpen', 8, 2)->nullable(); //: 28.815,
            $table->bigInteger('iexOpenTime')->nullable(); //: 1607461192355,
            $table->decimal('iexClose', 8, 2)->nullable(); //: 28.815,
            $table->bigInteger('iexCloseTime')->nullable(); //: 1607461192355,
            $table->bigInteger('marketCap')->nullable(); //: 2502673458439,
            $table->decimal('peRatio', 8, 2)->nullable(); //: 14.23,
            $table->decimal('week52High', 8, 2)->nullable(); //: 34.68,
            $table->decimal('week52Low', 8, 2)->nullable(); //: 17.50,
            $table->float('ytdChange', 10, 10)->nullable(); //: -0.1573975163337491,
            $table->bigInteger('lastTradeTime')->nullable(); //: 1607461198587,
            $table->string('currency')->nullable(); //: "USD",
            $table->boolean('isUSMarketOpen')->nullable(); //: false

            $table->timestamps();

            $table->foreign('symbol')->references('symbol')->on('company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote');
    }
};
