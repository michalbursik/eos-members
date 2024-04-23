<?php

use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestResponse;
use Modules\Member\Models\Member;
use Modules\Member\Models\MemberTag;

beforeEach(function () {
    $this->headers = ['Accept' => 'application/json'];
});

it('can show all members with member tags', function () {
    /** @var Collection<Member> $members */
    $members = Member::factory()->count($membersCount = 10)->create();
    $memberTagsCount = 3;
    foreach ($members as $member) {
        MemberTag::factory()->count($memberTagsCount)->create([
            'member_id' => $member->id
        ]);
    }

    /** @var TestResponse $response */
    $response = $this->get(route('members.index', [
        'with' => 'memberTags',
    ]), $this->headers);

    $responseData = $response->json('data');

    expect($response->status())->toBe(Response::HTTP_OK)
        ->and(count($responseData))->toBe($membersCount)
        ->and(count(Arr::first($responseData)['memberTags']))->toBe($memberTagsCount);
});

it('can show a member', function () {
    $member = Member::factory()->create();

    /** @var TestResponse $response */
    $response = $this->get(route('members.show', $member->id), $this->headers);

    $responseData = $response->json('data');

    expect($response->status())->toBe(Response::HTTP_OK)
        ->and($responseData['id'])->toBe($member->id);
});

it('can show a member with member tags', function () {
    /** @var Member $member */
    $member = Member::factory()->create();
    MemberTag::factory()->count($memberTagsCount = 5)->create([
        'member_id' => $member->id
    ]);

    /** @var TestResponse $response */
    $response = $this->get(
        route('members.show', [
            'member_id' => $member->id,
            'with' => 'memberTags',
        ]), $this->headers);

    $responseData = $response->json('data');

    expect($response->status())->toBe(Response::HTTP_OK)
        ->and($responseData['id'])->toBe($member->id)
        ->and(count($responseData['memberTags']))->toBe($memberTagsCount);
});

it('can store a member', function () {
    /** @var TestResponse $response */
    $response = $this->post(
        route('members.store'),
        $data = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@doe.com',
        'birthdate' => '2000-01-01',
    ], $this->headers);

    $responseData = $response->json('data');

    $member = Member::query()->latest()->first();

    expect($response->status())->toBe(Response::HTTP_CREATED)
        ->and($responseData)->toMatchArray($data)
        ->and($responseData['id'])->toBe($member->id);
});

it('can update a member', function () {
    $member = Member::factory()->create();

    /** @var TestResponse $response */
    $response = $this->put(
        route('members.update', $member->id),
        [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@doe.com',
            'birthdate' => '2000-01-01',
        ], $this->headers);

    expect($response->status())->toBe(Response::HTTP_NO_CONTENT);
});

it('can delete a member', function () {
    $member = Member::factory()->create();

    /** @var TestResponse $response */
    $response = $this->delete(
        route('members.destroy', $member->id)
    );

    expect($response->status())->toBe(Response::HTTP_NO_CONTENT);
});

it('can link a member tag to a member', function () {
    $member = Member::factory()->create();
    $memberTag = MemberTag::factory()->create();

    $response = $this->post(
        route('members.memberTag.link', ['member_id' => $member->id, 'member_tag_id' => $memberTag->id])
    );

    expect($response->status())->toBe(Response::HTTP_NO_CONTENT)
        ->and($member->memberTags()->first()->id)->toBe($memberTag->id);
});

