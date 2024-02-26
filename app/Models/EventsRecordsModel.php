<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsRecordsModel extends Model
{
    use HasFactory;
     protected $table = 'tbl_eventsrecords';
    public $timestamps = false;
    protected $primaryKey = 'eventRecordID';
}
