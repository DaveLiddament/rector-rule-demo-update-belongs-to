<?php

namespace App\Tools\Rector\Tests\FixModelMappingsRector\Fixture;

use App\Framework\BelongsTo;
use App\Framework\Model;

final class Car extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo('User');
    }
}
-----
<?php

namespace App\Tools\Rector\Tests\FixModelMappingsRector\Fixture;

use App\Framework\BelongsTo;
use App\Framework\Model;

final class Car extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(App\Models\User::class);
    }
}