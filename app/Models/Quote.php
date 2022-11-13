<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'quote';
    protected $appends = [
        'lastUpdate'
    ];

    protected $fillable = [
        'company_id', 'symbol', 'companyName', 'primaryExchange','calculationPrice','open', 'openTime','openSource','close','closeTime',
        'closeSource','high','highTime','highSource','low','lowTime','lowSource','latestPrice','latestSource','latestTime',
        'latestUpdate','latestVolume','iexRealtimePrice','iexRealtimeSize', 'iexLastUpdated', 'delayedPrice','delayedPriceTime',
        'oddLotDelayedPrice','oddLotDelayedPriceTime', 'extendedPrice', 'extendedChange','extendedChangePercent','extendedPriceTime',
        'previousClose', 'previousVolume','change','changePercent','volume','iexMarketPercent','iexVolume','avgTotalVolume',
        'iexBidPrice','iexBidSize','iexAskPrice','iexAskSize','iexOpen','iexOpenTime','iexClose','iexCloseTime','marketCap',
        'peRatio','week52High','week52Low','ytdChange','lastTradeTime','currency','isUSMarketOpen'
   ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getLastUpdateAttribute()
    {
        return Carbon::createFromTimestampMsUTC($this->latestUpdate)->format('Y-m-d');
    }
}
