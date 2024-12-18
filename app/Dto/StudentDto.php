<?php

namespace App\Dto;

class StudentDto
{
    public function __construct(
        public string $name,
        public string $email,
        public int $phonenumber,
        public string $address,
        public string $city,
        public string $state,
        public string $country,
        public string $zipcode,
        public int $role,
        public string $gender,
        public string $dob
) {}

    public static function fromRequest($request): self
    {
        return new self(
            $request->name,
            $request->email,
            $request->phonenumber,
            $request->address,
            $request->city,
            $request->state,
            $request->country,
            $request->zipcode,
            $request->role,
            $request->gender,
            $request->dob
        );
    }
}
