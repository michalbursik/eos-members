<?php

namespace Modules\Member\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\BodyParam;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Header;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\UrlParam;
use Modules\Member\DTOs\MemberDto;
use Modules\Member\Http\Requests\StoreMemberRequest;
use Modules\Member\Http\Requests\UpdateMemberRequest;
use Modules\Member\Interfaces\MemberRepositoryInterface;
use Modules\Member\Models\MemberTag;
use Modules\Member\Resources\MemberCollection;
use Modules\Member\Resources\MemberResource;
use Symfony\Component\HttpFoundation\Response;

class MemberController extends Controller
{
    public function __construct(private readonly MemberRepositoryInterface $memberRepository) {}

    #[Group('Members')]
    #[Endpoint('Get a list of members')]
    #[QueryParam('with', 'string', 'The relationship to load', required: false, example: 'memberTags', enum: ['memberTags'])]
    public function index(): MemberCollection
    {
        $members = $this->memberRepository->getAll();

        return new MemberCollection($members);
    }

    #[Group('Members')]
    #[Endpoint('Store a member')]
    #[BodyParam('first_name', 'string', required: true, example: 'John')]
    #[BodyParam('last_name', 'string', required: true, example: 'Doe')]
    #[BodyParam('email', 'string', required: true, example: 'john@doe.com')]
    #[BodyParam('birthdate', 'string', required: true, example: '2000-01-01')]
    public function store(StoreMemberRequest $request): MemberResource
    {
        $member = $this->memberRepository->store(MemberDto::fromRequest($request->validated()));

        return new MemberResource($member);
    }

    #[Group('Members')]
    #[Endpoint('Get a member')]
    #[UrlParam('member_id', 'int', 'The ID of the member', required: true, example: 1)]
    #[QueryParam('with', 'string', 'The relationship to load', required: false, example: 'memberTags', enum: ['memberTags'])]
    public function show(int $memberId): MemberResource
    {
        $member = $this->memberRepository->get($memberId);

        return new MemberResource($member);
    }

    #[Group('Members')]
    #[Endpoint('Update a member')]
    #[UrlParam('member_id', 'int', 'The ID of the member', required: true, example: 1)]
    #[BodyParam('first_name', 'string', required: true, example: 'John')]
    #[BodyParam('last_name', 'string', required: true, example: 'Doe')]
    #[BodyParam('email', 'string', required: true, example: 'john@doe.com')]
    #[BodyParam('birthdate', 'string', required: true, example: '2000-01-01')]
    public function update(UpdateMemberRequest $request, int $memberId): JsonResponse
    {
        $this->memberRepository->update($memberId, MemberDto::fromRequest($request->validated()));

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    #[Group('Members')]
    #[Endpoint('Delete a member')]
    #[UrlParam('member_id', 'int', 'The ID of the member', required: true, example: 1)]
    public function destroy(int $memberId): JsonResponse
    {
        $this->memberRepository->delete($memberId);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    #[Group('Members')]
    #[Endpoint('Attach a member tag to a member')]
    #[Header('Content', 'application/json')]
    #[UrlParam('member_id', 'int', 'The ID of the member', required: true, example: 1)]
    #[UrlParam('member_tag_id', 'int', 'The ID of the member tag', required: true, example: 1)]
    public function attachMemberTag(int $memberId, int $memberTagId): JsonResponse
    {
        $member = $this->memberRepository->get($memberId);

        $member->memberTags()->save(MemberTag::query()->findOrFail($memberTagId));

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
