<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\EmailVerifiedAt;
use App\Domain\User\ValueObject\EncriptedPassword;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\PlainPassword;
use Carbon\CarbonImmutable;

/**
 * ユーザー
 */
final class UserEntity
{
    public const NAME = 'ユーザー';

    /**
     * @param int|null               $id
     * @param Name                   $name
     * @param Email                  $email
     * @param EmailVerifiedAt        $emailVerifiedAt
     * @param EncriptedPassword|null $encriptedPassword
     * @param PlainPassword|null     $plainPassword
     */
    private function __construct(
        private ?int $id,
        private Name $name,
        private Email $email,
        private EmailVerifiedAt $emailVerifiedAt,
        private ?EncriptedPassword $encriptedPassword,
        private ?PlainPassword $plainPassword,
    ) {
    }

    /**
     * @param  array<string, int|string> $args
     * @return self
     */
    public static function create(array $args): self
    {
        $encriptedPassword = array_key_exists('encripted_password', $args)
            ? new EncriptedPassword((string) $args['encripted_password'])
            : null;

        $plainPassword = array_key_exists('plain_password', $args)
            ? new PlainPassword((string) $args['plain_password'])
            : null;

        return new self(
            null,
            new Name((string) $args['name']),
            new Email((string) $args['email']),
            new EmailVerifiedAt(new CarbonImmutable((string) $args['email_verified_at'])),
            $encriptedPassword,
            $plainPassword,
        );
    }

    /**
     * @param  int                    $id
     * @param  Name                   $name
     * @param  Email                  $email
     * @param  EmailVerifiedAt        $emailVerifiedAt
     * @param  EncriptedPassword|null $encriptedPassword
     * @param  PlainPassword|null     $plainPassword
     * @return self
     */
    public static function reconstruct(
        int $id,
        Name $name,
        Email $email,
        EmailVerifiedAt $emailVerifiedAt,
        ?EncriptedPassword $encriptedPassword,
        ?PlainPassword $plainPassword
    ): self {
        return new self(
            $id,
            $name,
            $email,
            $emailVerifiedAt,
            $encriptedPassword,
            $plainPassword,
        );
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return EmailVerifiedAt
     */
    public function getEmailVerifiedAt(): EmailVerifiedAt
    {
        return $this->emailVerifiedAt;
    }

    /**
     * @return EncriptedPassword|null
     */
    public function getEncriptedPassword(): ?EncriptedPassword
    {
        return $this->encriptedPassword;
    }

    /**
     * @return PlainPassword|null
     */
    public function getPlainPassword(): ?PlainPassword
    {
        return $this->plainPassword;
    }

    /**
     * 認証トークンのkeyを生成
     *
     * @param  int    $id
     * @return string
     */
    public function createTokenKey(int $id): string
    {
        return "userId:{$id}";
    }
}
