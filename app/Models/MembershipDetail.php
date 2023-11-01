<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipDetail extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'nid',
        'dob',
        'batch',
        'address',
        'blood_group',
        'employeer_name',
        'designation',
        'employeer_address',
        'reference',
        'reference_number',
        'user_id',
    ];

    public static function createNewMember(array $data)
    {
        return self::create($data);
    }

    public function getMemberList(array|null $values = null, $from = null, $to = null, $order = "DESC", $limit = null)
    {
        $data = $this->orderBy("updated_at", $order);

        $data->when($values, function($q) use ($values){
            $q->get($values);
        })->when($from, function($q) use ($from, $to){
            $q->whereBetween("updated_at", [$from, $to]);
        })->when($limit, function($q) use ($limit){
            $q->take($limit);
        });

        return $data->get()->toArray();
    }
}
