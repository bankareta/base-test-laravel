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

               $menu->add('Ceremonial')
               ->data('icon', 'pencil alternate')
               ->data('group', 2)
               ->nickname('ceremonial')
               ->data('perms', [
                    'ceremonial',
               ])
               ->active('ceremonial/*');

               $menu->ceremonial->add('Ceremonial', 'ceremonial/ceremonial/')
               ->data('perms', 'ceremonial')
               ->data('act','cru')
               ->data('group', 2)
               ->active('ceremonial/ceremonial/*');
               
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
               
               $menu->monitoring->add('Whises', 'monitoring/whises/')
               ->data('perms', 'whises')
               ->data('act','rd')
               ->data('group', 2)
               ->active('monitoring/whises/*');
               
               $menu->monitoring->add('Reservation', 'monitoring/resv/')
               ->data('perms', 'resv')
               ->data('act','rd')
               ->data('group', 2)
               ->active('monitoring/resv/*');
               
               $menu->monitoring->add('Gift', 'monitoring/gift/')
               ->data('perms', 'gift')
               ->data('act','rd')
               ->data('group', 2)
               ->active('monitoring/gift/*');


               $menu->add('Tamu Undangan')
               ->data('icon', 'address book outline')
               ->data('group', 3)
               ->nickname('invitation')
               ->data('perms', [
                    'digital',
                    'fisik',
               ])
               ->active('invitation/*');

               $menu->invitation->add('Digital', 'invitation/digital/')
               ->data('perms', 'digital')
               ->data('act','crud')
               ->data('group', 3)
               ->active('invitation/digital/*');

               $menu->invitation->add('Fisik', 'invitation/fisik/')
               ->data('perms', 'fisik')
               ->data('act','crud')
               ->data('group', 3)
               ->active('invitation/fisik/*');

               $menu->add('Planning')
               ->data('icon', 'tasks')
               ->data('group', 4)
               ->nickname('planning')
               ->data('perms', [
                    'budget-list',
                    'seserahan-list',
               ])
               ->active('planning/*');

               $menu->planning->add('Wedding List', 'planning/budget-list/')
               ->data('perms', 'budget-list')
               ->data('act','crud')
               ->data('group', 4)
               ->active('planning/budget-list/*');

               $menu->planning->add('Seserahan List', 'planning/seserahan-list/')
               ->data('perms', 'seserahan-list')
               ->data('act','crud')
               ->data('group', 4)
               ->active('planning/seserahan-list/*');

               $menu->add('Design Undangan Digital')
               ->data('icon', 'tasks')
               ->data('group', 5)
               ->nickname('undangan')
               ->data('perms', [
                    'segment',
                    'prewedding',
               ])
               ->active('undangan/*');

               $menu->undangan->add('Photo Prewedding', 'undangan/prewedding/')
               ->data('perms', 'prewedding')
               ->data('act','crud')
               ->data('group', 5)
               ->active('undangan/prewedding/*');

               $menu->undangan->add('Segment', 'undangan/segment/')
               ->data('perms', 'segment')
               ->data('act','crud')
               ->data('group', 5)
               ->active('undangan/segment/*');
               
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
