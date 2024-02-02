# Demo of a Rector rule

This support my talk "Elevating Legacy: A Case Study on the migration from Laravel 4 to 9"

This demonstrates a rector rule that updates calls the `belongsTo` method on a class that extends `Model` to use the `::class` constant if a string had been used.

E.g. 

```diff
- return $this->belongsTo('User');
+ return $this->belongsTo(App\Models\User::class);
```

To see what the rector rule would do, clone this project, run composer install, then from the root directory run the following command:

```bash
vendor/bin/rector process --dry-run
```

You'll see that it will fix the call to `belongsTo` in the `Car::user` method.

It leaves the `belongsTo` call in the `Car::manufacturer` method alone, as it is already using the `::class` constant.

Note that call to `belongsTo` in the `App\Service\CarService::doSomething` method is not updated, as it is not a call on a class that extends `Model`.

