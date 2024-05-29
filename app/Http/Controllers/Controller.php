<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use HasRoles;
use App\Models\Notification\Notification;
use Auth;
use Helpers;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $breadcrumb = ["Home" => "#"];
    private $link = "";
    private $perms = "";
    private $title = "Title";
    private $subtitle = " ";
    private $tableStruct = [];
    private $modalSize = "mini";
    private $action = "create";
    private $jalur = "academic";
    private $appClose = false;
    private $setErrorPage = [];

    public function setBreadcrumb($value=[])
    {
        $this->breadcrumb = $value;
    }

    public function setErrorPage($value=[])
    {
        $this->errorPage = $value;
    }

    public function getErrorPage()
    {
        return $this->errorPage;
    }

    public function pushBreadCrumb($value=[])
    {
        array_push($this->breadcrumb, $value);
    }

    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    public function setTableStruct($value=[])
    {
        $this->tableStruct = $value;
    }

    public function getTableStruct()
    {
        return $this->tableStruct;
    }

    public function setTitle($value="")
    {
        $this->title = $value;
    }

    public function setAppClose($value="")
    {
        $this->appClose = $value;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setSubtitle($value="")
    {
        $this->subtitle = $value;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setLink($value="")
    {
        $this->link = $value;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setPerms($value="")
    {
        $this->perms = $value;
    }

    public function getPerms()
    {
        return $this->perms;
    }

    public function getAppClose()
    {
        return $this->appClose;
    }

    public function setModalSize($value="mini")
    {
        $this->modalSize = $value;
    }

    public function getModalSize()
    {
        return $this->modalSize;
    }

    public function setAction($value="create")
    {
        $this->action = $value;
    }

    public function setJalur($value="academic")
    {
        $this->jalur = $value;
    }

    public function getAction()
    {
        return $this->action;
    }
    public function setMonitor($value="")
    {
        $this->monitor = $value;
    }

    public function render($view, $additional=[])
    {
        if(isset($this->monitor)){
            $monitor = true;
        }else{
            $monitor = false;
        }
        $notifs = 0;
        $arr = [];
        $data = [
            'breadcrumb' => $this->breadcrumb,
            'errorPage' => isset($this->errorPage) ? $this->errorPage : [],
            'title'      => $this->title,
            'subtitle'   => $this->subtitle,
            'pageUrl'    => $this->link,
            'pagePerms'  => $this->perms,
            'modalSize'  => $this->modalSize,
            'tableStruct'=> $this->tableStruct,
            'mockup'     => true,
            'action'     => $this->action,
            'jalur'      => $this->jalur,
            'appClose'   => $this->appClose,
            'monitorPage'   => $monitor,
            'notifs'     => count($arr)
        ];
        $filter = $this->perms;

        if(auth()->user())
        {
            $show  = auth()->user()->getAllPermissions()->filter(function ($q) use ($filter) {
                return starts_with($q->name,$filter);
            })->pluck('name');

            if($this->perms != '' && $show->count() == 0){
                return abort('404');
            }
        }

        return view($view, array_merge($data, $additional));
    }

    public function makeButton($params = [])
    {
        $settings = [
            'id'    => '',
            'class'    => 'blue',
            'label'    => 'Button',
            'function'    => '',
            'tooltip'  => '',
            'target'   => url('/'),
            'disabled' => '',
            'url' => '',
        ];

        $btn = '';
        $datas = '';
        $attrs = '';

        if (isset($params['datas'])) {
            foreach ($params['datas'] as $k => $v) {
                $datas .= " data-{$k}=\"{$v}\"";
            }
        }

        if (isset($params['attributes'])) {
            foreach ($params['attributes'] as $k => $v) {
                $attrs .= " {$k}=\"{$v}\"";
            }
        }

        switch ($params['type']) {
            case "verifikasi":
                $settings['class']   = 'green icon delete';
                $settings['label']   = '<i class="check icon"></i>';
                $settings['tooltip'] = 'Verifikasi Data';

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' onclick=\"verifikasiData('".$params['code']."', '".$params['url']."')\" {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                break;
            case "custom-delete":
                $settings['class']   = 'red icon delete';
                $settings['label']   = '<i class="trash icon"></i>';
                $settings['tooltip'] = 'Delete Data';
                $settings['disabled'] = '';

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";
                $btn = "<button type='button' onclick=\"deleteData('".$params['url']."')\"
                {$datas}{$attrs}{$extends} class='ui mini {$params['class']} ".($params['disabled'] ? ($params['disabled'] == 'disabled' ? 'disabled':'') : 'disabled')." button'>{$params['label']}</button>\n";
                break;
            case "delete":
                $settings['class']   = 'red icon delete';
                $settings['label']   = '<i class="trash icon"></i>';
                $settings['tooltip'] = 'Delete Data';
                if(isset($params['disabled'])){
                    $settings['disabled'] = true;
                }else{
                    $settings['disabled'] = auth()->user()->can($this->perms.'-delete');
                }

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";
                $btn = "<button type='button' onclick=\"deleteData('".$params['url']."')\"
                {$datas}{$attrs}{$extends} class='ui mini {$params['class']} ".($params['disabled'] ? '' : 'disabled')." button'>{$params['label']}</button>\n";
                break;
            case "approve-custom":
                $settings['class']   = 'blue icon approve';
                $settings['label']   = '<i class="book icon"></i>';
                $settings['labeled']   = 'Approve';
                $settings['url']   = $this->link.'/approve/';
                $settings['tooltip'] = 'Approve Data';
                $settings['disabled'] = auth()->user()->can($this->perms.'-approval');

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";
                $btn = "<button type='button' onclick=\"approveData('".$params['url']."','".$params['labeled']."')\"
                {$datas}{$attrs}{$extends} class='ui mini {$params['class']} ".($params['disabled'] ? ($params['disabled'] == 'disabled' ? 'disabled':'') : 'disabled')." button'>{$params['label']}</button>\n";
                break;
            case "edit":
                $settings['class']   = 'blue icon edit';
                $settings['label']   = '<i class="edit icon"></i>';
                $settings['tooltip'] = 'Edit Data';

                if(isset($params['disabled'])){
                    $settings['disabled'] = true;
                }else{
                    $settings['disabled'] = auth()->user()->can($this->perms.'-edit') ? false : true;
                }

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<a href=\"{$params['url']}\" {$datas}{$attrs}{$extends} class='ui mini {$params['class']} ".($params['disabled'] ? '' : 'disabled')." button' {$params['disabled']}>{$params['label']}</a>\n";
                break;
            case "edit-page":
                $settings['class']   = 'blue icon edit-page';
                $settings['label']   = '<i class="edit icon"></i>';
                $settings['tooltip'] = 'Edit Data';
                if(isset($params['disabled'])){
                    $settings['disabled'] = true;
                }else{
                    $settings['disabled'] = auth()->user()->can($this->perms.'-edit') ? false : true;
                }
                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";
                $btn = '';

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} ".($params['disabled'] ? '' : 'disabled')." button' {$params['disabled']}>{$params['label']}</button>\n";
                break;
            case "edit-modal":
                $settings['class']   = 'blue icon detail-modal';
                $settings['label']   = '<i class="edit icon"></i>';
                $settings['tooltip'] = 'Edit Data';
                $settings['disabled'] = auth()->user()->can($this->perms.'-edit') ? false : true;

                if(isset($params['disabled'])){
                    $settings['disabled'] = true;
                }else{
                    $settings['disabled'] = auth()->user()->can($this->perms.'-delete');
                }

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} data-url='{$params['url']}' class='ui mini {$params['class']} ".($params['disabled'] ? '' : 'disabled')." button' {$params['disabled']}>{$params['label']}</button>\n";
                break;
            case "detail-modal":
                $settings['class']   = 'teal icon detail-modal';
                $settings['label']   = '<i class="eye icon"></i>';
                $settings['tooltip'] = 'Detail Data';
                $settings['disabled'] = '';

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} data-url='{$params['url']}' class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                break;
            case "detail-page":
                $settings['class']   = 'teal icon detail-page';
                $settings['label']   = '<i class="eye icon"></i>';
                $settings['tooltip'] = 'Detail Data';
                $settings['disabled'] = '';

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                break;
            case "revisi-page":
                $settings['class']   = 'yellow icon revisi-page';
                $settings['label']   = '<i class="file icon"></i>';
                $settings['tooltip'] = 'Revise Data';

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button'>{$params['label']}</button>\n";
                break;
            case "review-page":
                $settings['class']   = 'green icon review-page';
                $settings['label']   = '<i class="zoom icon"></i>';
                $settings['tooltip'] = 'Review Data';

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button'>{$params['label']}</button>\n";
                break;
            case "approve-page":
                $settings['class']   = 'black icon approve-page';
                $settings['label']   = '<i class="check icon"></i>';
                $settings['tooltip'] = 'Approve Page';

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                break;
            case "modal":
                $settings['onClick'] = '';
                $settings['class']   = 'blue icon edit';
                $settings['label']   = '<i class="edit icon"></i>';
                $settings['tooltip'] = 'Edit Data';

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} ".(!$params['disabled'] ? 'disabled' : '')." button' {$params['disabled']} onclick='{$params['onClick']}'>{$params['label']}</button>\n";
                break;
            case "print":
                $settings['class']   = 'orange icon print-pdf';
                $settings['label']   = '<i class="print icon"></i>';
                $settings['tooltip'] = 'Print';

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}' data-url='{$params['url']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}>{$params['label']}</button>\n";
                break;
            case "active":
                $settings['onClick'] = '';
                $settings['class']   = 'teal icon check change-status';
                $settings['label']   = '<i class="check icon"></i>';
                $settings['tooltip'] = 'Deactivate?';
                $settings['disabled'] = true;

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-stats = 'active' data-id='{$params['id']}' data-url='{$params['url']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']}".($params['disabled'] ? ($params['disabled'] == 'disabled' ? 'disabled':'') : 'disabled')." button' {$params['disabled']} onclick='{$params['onClick']}'>{$params['label']}</button>\n";
                break;
            case "deactive":
                $settings['onClick'] = '';
                $settings['class']   = 'black icon x change-status';
                $settings['label']   = '<i class="x icon"></i>';
                $settings['tooltip'] = 'Deactivate?';
                $settings['disabled'] = true;

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-stats = 'deactive' data-id='{$params['id']}' data-url='{$params['url']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']}".($params['disabled'] ? ($params['disabled'] == 'disabled' ? 'disabled':'') : 'disabled')." button' {$params['disabled']} onclick='{$params['onClick']}'>{$params['label']}</button>\n";
                break;
            case "no-action":
                $settings['onClick'] = '';
                $settings['class']   = 'black icon x';
                $settings['label']   = '<i class="x icon"></i>';
                if($params['status'] == 1){
                    $settings['class']   = 'teal icon check';
                    $settings['label']   = '<i class="check icon"></i>';
                }
                $settings['tooltip'] = 'Deactivate?';
                $settings['disabled'] = true;

                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}' data-url='{$params['url']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} class='ui mini {$params['class']}".($params['disabled'] ? ($params['disabled'] == 'disabled' ? 'disabled':'') : 'disabled')." button' {$params['disabled']} onclick='{$params['onClick']}'>{$params['label']}</button>\n";
                break;
            case "url":
            default:
                $settings['onClick']   = '';
                $settings['class']   = 'blue icon';
                $settings['label']   = '<i class="eye icon"></i>';

                $params  = array_merge($settings, $params);
                $extends = '';
                if($params['tooltip'] != '')
                {
                    $extends = " data-content='{$params['tooltip']}'";
                }

                $btn = "<a target='_blank' href='{$params['url']}' {$datas}{$attrs}{$extends} class='ui mini {$params['class']} button' {$params['disabled']}'  onclick='{$params['onClick']}'>{$params['label']}</a>\n";
        }

        return $btn;
    }

}
