<?php

namespace Terranet\Administrator\Dashboard\Panels;

use Terranet\Administrator\Architect;
use Terranet\Administrator\Dashboard\Panel;
use Terranet\Administrator\Traits\Stringify;
use function admin\db\connection;

class DatabasePanel extends Panel
{
    use Stringify;

    public function render(): string
    {
        $dbStats = $this->getDatabaseStats();

        return view(Architect::template()->dashboard('database'), [
            'dbStats' => $dbStats,
        ]);
    }

    /**
     * @return mixed
     */
    protected function getDatabaseStats(): mixed
    {
        if (connection('mysql')) {
            return $this->connection()->select('SHOW TABLE STATUS');
        }

        return collect([]);
    }

    protected function connection()
    {
        return app('db');
    }
}
