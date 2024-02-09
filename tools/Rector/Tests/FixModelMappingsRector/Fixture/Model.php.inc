<?php

namespace App\Tools\Rector\Tests\FixModelMappingsRector\Fixture;

use App\Framework\BelongsTo;
use App\Framework\Model;
use App\Models\Manufacturer;

final class Car extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo('User');
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
-----
<?php

namespace App\Tools\Rector\Tests\FixModelMappingsRector\Fixture;

use App\Framework\BelongsTo;
use App\Framework\Model;
use App\Models\Manufacturer;

final class Car extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(App\Models\User::class);
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }
}