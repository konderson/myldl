<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;
use DateTime;
class User extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
     public function person()
  {
     
    return $this->hasOne('App\Person','user_id');
  }
     
     public function role()
  {
     
    return $this->hasOne('App\Admin\Roles','user_id');
  }
  
   public function comentDela()
  {
     
    return $this->hasOne('App\Person','user_id');
  }
  
    public function need()
  {
    return $this->belongsToMany('App\WontNeed','user_need','user_id','need_id');
  }
  
  
  public function event()
  {
    return $this->hasMany('App\Event');
  }
  
     public function delo ()
  {
    return $this->belongsToMany('App\Dela','user_dela','user_id','delo_id');
  }
  
     public function deloFeatured ()
  {
    return $this->belongsToMany('App\Dela','delo_featureds','user_id','delo_id');
  }
  public function isOnline()
{

$flag=Cache::has('user-is-online-' . $this->id);

if($flag){
    return true;
}
else{
    return false;
}
}
  public static function getTime($date)// $date --> время в формате Unix time
{
    $stf      = 0;
    $cur_time = time();
    $diff     = $cur_time - $date;
 
    $seconds = array( 'секунда', 'секунды', 'секунд' );
    $minutes = array( 'минута', 'минуты', 'минут' );
    $hours   = array( 'час', 'часа', 'часов' );
    $days    = array( 'день', 'дня', 'дней' );
    $weeks   = array( 'неделя', 'недели', 'недель' );
    $months  = array( 'месяц', 'месяца', 'месяцев' );
    $years   = array( 'год', 'года', 'лет' );
    $decades = array( 'десятилетие', 'десятилетия', 'десятилетий' );
 
    $phrase = array( $seconds, $minutes, $hours, $days, $weeks, $months, $years, $decades );
    $length = array( 1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600 );
 
    for ( $i = sizeof( $length ) - 1; ( $i >= 0 ) && ( ( $no = $diff / $length[ $i ] ) <= 1 ); $i -- ) {
        ;
    }
    if ( $i < 0 ) {
        $i = 0;
    }
    $_time = $cur_time - ( $diff % $length[ $i ] );
    $no    = floor( $no );
    $value = sprintf( "%d %s ", $no, ParseForDate::getPhrase( $no, $phrase[ $i ] ) );
 
    if ( ( $stf == 1 ) && ( $i >= 1 ) && ( ( $cur_time - $_time ) > 0 ) ) {
        $value .= time_ago( $_time );
    }
 
    return $value;

  }
  

   public static function getAge($birthday){
    // выделяем день, месяц, год из даты рождения
    $bDay = substr($birthday, 8, 2);
    $bMonth = substr($birthday, 5, 2);
    $bYear = substr($birthday, 0, 4);
    if(!is_numeric($bYear)){return 0;}
    // текущие день, месяц, год
    $cDay = date('j');
    $cMonth = date('n');
    $cYear = date('Y');
    
    if(($cMonth > $bMonth) || ($cMonth == $bMonth && $cDay >= $bDay)) {
        return ($cYear - $bYear);
    } else {
        return ($cYear - $bYear - 1);
    }
}
  

}