<?php

namespace App\Models;

use App\Http\Controllers\AccountsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;
    // protected $fillable = ['firstName', 'lastName', 'username', 'password', 'email', 'userType','dateCreated', 'isActive'];
    protected $table = 'tbl_accounts';
    public $timestamps = false;
    protected $primaryKey = 'id';

   
    public function scopeFilter($query, array $filters,$select,$advsearch){

        // dd($filters['search']);
        if($filters['search'] ?? false){
        
            $query->orWhere('id', '=', request('search') )
            ->orWhere('firstName', 'like', '%' . request('search') . '%')
            ->orWhere('lastName', 'like', '%' . request('search') . '%')
            ->orWhere('username', 'like', '%' . request('search') . '%')
            ->orWhere('email', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_usertype.utName', 'like', '%' . request('search') . '%')
            ->orWhere('dateCreated', 'like', '%' . request('search') . '%');
    
         
        }
        elseif($advsearch && $select ?? false){
         
            if($select == "id"){
             
                $query->where('tbl_accounts.id', '=',  $advsearch);
              
            }
            else if($select == "userType"){
                $query->where('tbl_usertype.utName', 'like', '%' .$advsearch. '%');
            }
            else{
                $query->where($select, 'like', '%' . $advsearch . '%');
        
            }
         
        }
       
    }

   
}
