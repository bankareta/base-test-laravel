<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\InductionQuestionRequest;

/* Models */
use App\Models\Master\Induction;
use App\Models\Master\InductionQuestion;
use App\Models\Master\InductionQuestionFile;
use App\Models\Master\InductionQuestionAnswer;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Storage;
use Hash;

class InductionQuestionController extends Controller
{
    protected $link = 'master/induction/';
    protected $perms = 'master-induction';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Manage Question Induction Material");
        $this->setModalSize("large");
        $this->setBreadcrumb(['Master' => '#', 'Induction Material' => '#','Manage' => '#','Question' => '#','Manage' => '#']);

        // Header Grid Datatable
        $this->setTableStruct([
            [
                'data' => 'num',
                'name' => 'num',
                'label' => '#',
                'orderable' => false,
                'searchable' => false,
                'className' => "center aligned",
                'width' => '40px',
            ],
            /* --------------------------- */
            [
                'data' => 'desc',
                'name' => 'desc',
                'label' => 'Question',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'materi.name',
                'name' => 'materi.name',
                'label' => 'Induction Material',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Created At',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Action',
                'searchable' => false,
                'sortable' => false,
                'className' => "center aligned",
                'width' => '150px',
            ]
        ]);
    }

    public function grid($kode,Request $request)
    {
        $records = InductionQuestion::with('materi')->where('materi_id',$kode)->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        //Filters
        if ($material_name = $request->material_name) {
            $records->where('desc', 'like', '%' . $material_name . '%');
        }

        $link = $this->link;
        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->editColumn('created_at', function ($record) {
                return $record->created_at->diffForHumans();
            })
            ->editColumn('desc', function ($record) {
                return substr($record->desc,0,50);
            })
            ->addColumn('action', function ($record) use ($kode){
                $btn = '';
                $link = 'master/induction/create-question/';

                $btn .= $this->makeButton([
                    'type' => 'detail-modal',
                    'id'   => $record->id,
                    'tooltip' => 'Detail Question',
                    'url'   => url($link.'detail-data/'.$record->id)
                ]);
                if($record->materi->status == 1){
                    $btn .= $this->makeButton([
                        'type' => 'edit',
                        'datas' => [
                            'id' => $record->id
                        ],
                        'disabled' => 'disabled',
                        'id'   => $record->id
                    ]);
                    // Delete
                    $btn .= $this->makeButton([
                        'type' => 'delete',
                        'id'   => $record->id,
                        'disabled' => 'disabled',
                        'url'   => url($link.'delete-data/'.$record->id)
                    ]);
                }else{
                    $btn .= $this->makeButton([
                        'type' => 'edit-modal',
                        'id'   => $record->id,
                        'tooltip' => 'Edit Question',
                        'url'   => url($link.'edit-data/'.$record->id)
                    ]);
                    // Delete
                    $btn .= $this->makeButton([
                        'type' => 'delete',
                        'id'   => $record->id,
                        'url'   => url($link.'delete-data/'.$record->id)
                    ]);
                }
                return $btn;
            })
            ->rawColumns(['action','status_user'])
            ->make(true);
    }

    public function index($id)
    {
        $link = 'master/induction/create-question/'.$id.'/';
        $this->setLink($link);
        return $this->render('modules.master.induction.question-grid.index', [
            'mockup' => false,
            'record' => Induction::find($id)
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|max:500',
            'answer.*' => 'required|max:500',
        ], [
            'question.required' => 'Question Can Not Be Empty',
            'question.max' => 'can not be more than :max character',
            'answer.*.required' => 'Answer Can Not Be Empty',
            'answer.*.max' => 'can not be more than :max character',
        ]);
        // InductionQuestionRequest
        try {
            $add['materi_id'] = $request->materi_id;
            $add['desc'] = $request->question;
            $add['status'] = $request->status;
            $record = new InductionQuestion;
            $record->fill($add);
            $record->save();

            $addAnswer['question_id'] = $record->id;
            $addAnswer['answer_1'] = $request->status == 1 ? '-':$request->answer[1];
            $addAnswer['answer_2'] = $request->status == 1 ? '-':$request->answer[2];
            $addAnswer['answer_3'] = $request->status == 1 ? '-':$request->answer[3];
            $addAnswer['answer_4'] = $request->status == 1 ? '-':$request->answer[4];
            $addAnswer['result'] = $request->true;
            $recordAnswer = new InductionQuestionAnswer;
            $recordAnswer->fill($addAnswer);
            $recordAnswer->save();

            if(isset($request->fileurl) AND count($request->fileurl) > 0){
                foreach ($request->fileurl as $key => $value) {
                    $addFile['question_id'] = $record->id;
                    $addFile['fileurl'] = $value;
                    $addFile['filename'] = $request->filesname[$key];
                    $recordFile = new InductionQuestionFile;
                    $recordFile->fill($addFile);
                    $recordFile->save();
                }
            }

            if(isset($request->filespathexist) AND count($request->filespathexist) > 0){
                foreach ($request->filespathexist as $key => $value) {
                    $filesname = 'induction/question/copy-'.str_replace('induction/question/','',$value);
                    $uri = storage_path().'/app/public/'.$value;
                    $files = file_get_contents($uri);
                    $exten = pathinfo($uri);
                    file_put_contents(storage_path().'/app/public/'.$filesname, $files);
                    $addFile2['question_id'] = $record->id;
                    $addFile2['fileurl'] = $filesname;
                    $addFile2['filename'] = $request->filesnameexist[$key];
                    $recordFile = new InductionQuestionFile;
                    $recordFile->fill($addFile2);
                    $recordFile->save();
                }
            }
            Trail::log($this->getTitle(), 'create question', request()->ip(), auth()->user()->id);
            return response([
                'status' => true
            ]);

        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }
    }

    public function create($id)
    {
        $this->setTitle("Create Induction Material");
        $this->setBreadcrumb(['Induction Material' => url($this->link), 'Create' => '#']);
        $link = 'master/induction/create-question/'.$id.'/';
        $this->setLink($link);
        return $this->render('modules.master.induction.question-grid.create',[
            'id' => $id,
        ]);
    }

    public function edit($id)
    {
        // $this->setTitle("Create Induction Material");
        // $this->setBreadcrumb(['Induction Material' => url($this->link), 'Edit' => '#']);
        $link = 'master/induction/create-question/'.$id.'/';
        $this->setLink($link);
        return $this->render('modules.master.induction.question-grid.edit',[
            'id' => $id,
            'record' => InductionQuestion::find($id)
        ]);
    }

    public function show($id)
    {
        // $this->setTitle("Create Induction Material");
        // $this->setBreadcrumb(['Induction Material' => url($this->link), 'Edit' => '#']);
        $link = 'master/induction/create-question/'.$id.'/';
        $this->setLink($link);
        return $this->render('modules.master.induction.question-grid.show',[
            'id' => $id,
            'record' => InductionQuestion::find($id)
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|max:500',
            'answer.*' => 'required|max:500',
        ], [
            'question.required' => 'Question Can Not Be Empty',
            'question.max' => 'can not be more than :max character',
            'answer.*.required' => 'Answer Can Not Be Empty',
            'answer.*.max' => 'can not be more than :max character',
        ]);
        // InductionQuestionRequest
        try {
            $add['desc'] = $request->question;
            $add['status'] = $request->status;
            $record = InductionQuestion::find($request->id);
            $record->fill($add);
            $record->save();
            $record->answer()->delete();

            $addAnswer['question_id'] = $record->id;
            $addAnswer['answer_1'] = $request->status == 1 ? '-':$request->answer[1];
            $addAnswer['answer_2'] = $request->status == 1 ? '-':$request->answer[2];
            $addAnswer['answer_3'] = $request->status == 1 ? '-':$request->answer[3];
            $addAnswer['answer_4'] = $request->status == 1 ? '-':$request->answer[4];
            $addAnswer['result'] = $request->true;
            $recordAnswer = new InductionQuestionAnswer;
            $recordAnswer->fill($addAnswer);
            $recordAnswer->save();

            if(isset($request->file_deleted_id) AND count($request->file_deleted_id) > 0){
                foreach ($request->file_deleted_id as $key => $idFile) {
                    $local = InductionQuestionFile::find($idFile);
                    if(isset($local)){
                        if(file_exists(storage_path().'/app/public/'.$local->fileurl))
                        {
                            unlink(storage_path().'/app/public/'.$local->fileurl);
                        }
                        $local->delete();
                    }
                }
            }

            if(isset($request->fileurl) AND count($request->fileurl) > 0){
                foreach ($request->fileurl as $key => $value) {
                    $addFile['question_id'] = $record->id;
                    $addFile['fileurl'] = $value;
                    $addFile['filename'] = $request->filesname[$key];
                    $recordFile = new InductionQuestionFile;
                    $recordFile->fill($addFile);
                    $recordFile->save();
                }
            }
            Trail::log($this->getTitle(), 'edited question', request()->ip(), auth()->user()->id);
            return response([
                'status' => true
            ]);

        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }
    }

    public function uploadImg(Request $request,$id)
    {
        try {
            $url = [];
            if(count($request->picture) > 0)
            {
                $i = 0;
                foreach($request->picture as $picture)
                {
                    $get = $picture->storeAs('induction/question', md5($picture->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$picture->getClientOriginalExtension(), 'public');
                    $url[$i]['url'] = asset('storage/'.$get);
                    $url[$i]['value'] = $get;
                    $url[$i]['filename'] = $picture->getClientOriginalName();

                    $i++;
                }
            }

            return response([
                'status' => true,
                'url' => $url,
            ]);

        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }
    }

    public function destroy($id)
    {
        $record = InductionQuestion::find($id);
        $record->files()->delete();
        $record->answer()->delete();
        Trail::log($this->getTitle(), 'deleted question', request()->ip(), auth()->user()->id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }

    public function manage($id)
	{
        $this->setTitle("Manage Induction Material");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Induction Material' => '#','Manage' => '#']);
        $record = Induction::find($id);

		return $this->render('modules.master.induction.question-grid.manage', [
            'record' => $record,
            // 'users' => $record->users()->paginate(30),
            // 'quizStruct' => $this->quizStruct,
        ]);
	}

    public function question($id)
	{
        $this->setTitle("Manage Question Induction Material");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Induction Material' => '#','Manage' => '#','Question' => '#','Manage' => '#']);
        $record = Induction::find($id);

		return $this->render('modules.master.induction.question-grid.question', [
            'record' => $record,
            // 'questionStruct' => $this->questionStruct,
        ]);
    }

    public function getPreQues($id_materi,$id)
    {
        $record = InductionQuestion::with('answer','files')->find($id);
        return response([
            'status' => true,
            'data' => $record
        ]);
    }
}
