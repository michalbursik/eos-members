<?php

namespace Modules\Member\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Member\DTOs\MemberDto;
use Modules\Member\Models\Member;

interface MemberRepositoryInterface
{
    public function getAll(): Collection;
    public function get(int $memberId): Member;
    public function store(MemberDto $memberDto): Member;
    public function delete(int $memberId): void;
    public function update(int $memberId, MemberDto $memberDto): Member;
}
