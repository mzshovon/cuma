<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_channel',
        'amount',
        'trans_id',
        'status',
        'image_path',
        'ip',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createNewPaymentRequest(array $data)
    {
        return self::create($data);
    }

    public static function updatePaymentRequest(array $data, $param, $value)
    {
        return self::where($param, $value)->update($data);
    }

    /**
     * @param null $limit
     * @param array|null|null $values
     * @param null $from
     * @param null $to
     * @param string $order
     *
     * @return [type]
     */
    public function getPayments($userId = null, array|null $values = null, $from = null, $to = null, $order = "DESC")
    {
        $data = $this->with("user")->orderBy("updated_at", $order);
        $data->when($userId, function($q) use ($userId){
            $q->whereUserId($userId);
        })->when($from, function($q) use ($from, $to){
            $q->whereBetween("updated_at", [$from, $to]);
        })->when($values, function($q) use ($values){
            $q->get($values);
        });

        return $data->get()->toArray();
    }

    /**
     * @param string $whereParam
     * @param mixed $value
     *
     * @return
     */
    public static function getSinglePaymentByParam(string $whereParam, $value)
    {
        return self::where($whereParam, $value)->first();
    }
}
