<?php

namespace Modules\Member\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Member\Models\MemberTag;

class MemberTagResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var MemberTag $memberTag */
        $memberTag = $this;

        return [
            'id' => $memberTag->id,
            'value' => $memberTag->value,
            'member_id' => $memberTag->member_id,
        ];
    }
}
