<?php

namespace Modules\Member\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Member\Models\Member;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Member $member */
        $member = $this;

        return [
            'id' => $member->id,
            'first_name' => $member->first_name,
            'last_name' => $member->last_name,
            'email' => $member->email,
            'birthdate' => $member->birthdate,
            'created_at' => $member->created_at,
            'updated_at' => $member->updated_at,
            'memberTags' => MemberTagResource::collection($this->whenLoaded('memberTags'))
        ];
    }
}
