<?php

declare(strict_types=1);

namespace App\Infrastructure\Models;

use App\Domain\Post\Entity\PostEntity;
use App\Domain\Post\ValueObject\Body;
use App\Domain\Post\ValueObject\IsPublic;
use App\Domain\Post\ValueObject\Title;
use App\Domain\Post\ValueObject\TopImagePath;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return PostEntity
     */
    public function toEntity(): PostEntity
    {
        $topImagePath = is_null($this->top_image_path)
            ? null
            : new TopImagePath($this->top_image_path);

        return PostEntity::reconstruct(
            $this->id,
            $this->user_id,
            new Title($this->title),
            new Body($this->body),
            $topImagePath,
            new IsPublic((bool) $this->is_public)
        );
    }
}
