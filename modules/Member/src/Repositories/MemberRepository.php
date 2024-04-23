<?php

namespace Modules\Member\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Member\DTOs\MemberDto;
use Modules\Member\Interfaces\MemberRepositoryInterface;
use Modules\Member\Models\Member;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

readonly class MemberRepository implements MemberRepositoryInterface
{
    /**
     * @return Collection<Member>
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAll(): Collection
    {
        $query = Member::query();

        if (request()->get('with') === 'memberTags') {
            $query->with('memberTags');
        }

        return $query->get();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function get(int $memberId): Member
    {
        $query = Member::query();

        if (request()->get('with') === 'memberTags') {
            $query->with('memberTags');
        }

        return $query->findOrFail($memberId);
    }

    public function store(MemberDto $memberDto): Member
    {
        $member = new Member($memberDto->toArray());

        $member->save();

        return $member;
    }

    public function update(int $memberId, MemberDto $memberDto): Member
    {
        $member = $this->get($memberId);

        $member->update($memberDto->toArray());

        return $member;
    }

    public function delete(int $memberId): void
    {
        $member = $this->get($memberId);

        $member->memberTags()->delete();
        $member->delete();
    }
}
