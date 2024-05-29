<?php

namespace App\Http\Middleware;
use App\Models\Master\Auditor;
use App\Models\Audit\DataAudit;

use Closure;
use Menu;

class GenerateMenus
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
          /* Data ACT [c(create), r(read), u(update), d(delete), a(approve), s(seeReviewed)] */
          Menu::make('mainMenu', function ($menu) {

               $menu->add('Dashboard', 'home')
               ->data('icon', 'dashboard')
               ->data('perms', 'dashboard')
               ->data('page', 'single')
               ->data('act','r')
               ->data('group', 1)
               ->active('home');
               
               $menu->add('Monitoring')
               ->data('icon', 'wpforms')
               ->data('group', 2)
               ->nickname('monitoring')
               ->data('perms', [
                    'visitor',
                    'whises',
                    'resv',
                    'gift',
               ])
               ->active('monitoring/*');

               $menu->monitoring->add('Visitor', 'monitoring/visitor/')
               ->data('perms', 'visitor')
               ->data('act','rd')
               ->data('group', 2)
               ->active('monitoring/visitor/*');
               
               
               /* Data Master */
               // $menu->add('Master Data')
               // ->data('icon', 'database')
               // ->data('perms', 'master')
               // ->data('group', 9)
               // ->active('master/*');

               // $menu->masterData->add('Vaccine Status', 'master/vaccine-status/')
               // ->data('perms', 'vaccine-status')
               // ->data('act','crud')
               // ->data('group', 6)
               // ->active('master/vaccine-status/*');

               /* Konfigurasi */
               $menu->add('Configuration')
               ->data('icon', 'settings')
               ->data('perms', 'konfigurasi')
               ->data('group', 9)
               ->active('konfigurasi/*');

               $menu->configuration->add('Dashboard Image', 'konfigurasi/dashboard-img/')
               ->data('perms', 'konfigurasi-dashboard-img')
               ->data('act','crud')
               ->active('konfigurasi/dashboard-img/*');

               $menu->configuration->add('User Management', 'konfigurasi/users/')
               ->data('perms', 'konfigurasi-users')
               ->data('act','crud')
               ->active('konfigurasi/users/*');

               $menu->configuration->add('Permissions & Roles', 'konfigurasi/roles/')
               ->data('perms', 'konfigurasi-roles')
               ->data('act','crud')
               ->active('konfigurasi/roles/*');

          });

          return $next($request);
     }
}
