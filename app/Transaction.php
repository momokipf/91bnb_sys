<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //

    protected $table = 'Transaction';

    /* primaryKey keyword*/

    protected $primaryKey = 'transactionID';

    public function inquiry(){
        return $this->belongsTo('App\Inquiry','inquiryID');
    }

    public function house(){
        return $this->belongsTo('App\House','numberID');
    }
}
