<?php

namespace Myrtle\Core\System\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Myrtle\System\Policies\SystemPolicy;
use Illuminate\Support\Facades\DB;

class SystemInformationController extends Controller
{
    public function index()
    {
    	$this->authorize('information', SystemPolicy::class);

    	$connection = DB::connection(config('database.default'));

        $database['driver'] = $connection->getDriverName();
        $database['name'] = $connection->getDatabaseName();
        $database['prefix'] = $connection->getTablePrefix();
        $database['version'] = $connection->getPdo()->getAttribute(\PDO::ATTR_SERVER_VERSION);

        $server['php']['uname'] = php_uname();
        $server['php']['version'] = phpversion();
        $server['web'] = env('SERVER_SOFTWARE');

        $server['git']['version'] = exec('git --version');

        $server['composer']['version'] = exec('composer --version');

        $agent = env('HTTP_USER_AGENT');

        return view('admin::system.information.index')
            ->withDatabase($database)
            ->withServer($server)
            ->withAgent($agent);
    }
}
