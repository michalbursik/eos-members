<?php

namespace Modules\Member\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Member\Database\Factories\MemberTagFactory;

/**
 *
 *
 * @property int $id
 * @property string $value
 * @property int|null $member_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Member\Models\Member|null $member
 * @method static \Modules\Member\Database\Factories\MemberTagFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTag whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberTag whereValue($value)
 * @mixin \Eloquent
 */
class MemberTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'value', 'member_id'
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public static function newFactory(): MemberTagFactory
    {
        return new MemberTagFactory();
    }
}
