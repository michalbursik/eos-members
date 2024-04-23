<?php

namespace Modules\Member\DTOs;

final readonly class MemberDto
{
    private function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $birthdate,
    ) {}

    public static function fromRequest(array $data): MemberDto
    {
        return new MemberDto(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['birthdate'],
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
        ];
    }
}
