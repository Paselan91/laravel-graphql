<?php

declare(strict_types=1);

namespace App\GraphQL\User\Query\Inputs;

final class FetchUserByIdInput
{
    /**
     * @param int $id
     */
    private function __construct(
        private int $id
    ) {
    }

    /**
     * @param  array<string, int> $args
     * @return self
     */
    public static function build(array $args): self
    {
        return new self(
            (int) $args['id']
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
