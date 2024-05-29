<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\Training\CourseRequest;
use App\Http\Requests\Master\Training\QuizRequest;
use App\Http\Requests\Master\Training\QuestionRequest;

/* Models */
use App\Models\Master\Training\QuestionImage;
use App\Models\Master\Training\Question;
use App\Models\Master\Training\Course;
use App\Models\Master\Training\Quiz;
use App\Models\Master\Training\QuizFiles;
use App\Models\Authentication\User;
use App\Models\Trail\Trail;

use App\Models\Notification\Notification;


/* Libraries */
use DataTables;
use Carbon\Carbon;

class TrainingController extends Controller
{
    protected $link = 'master/training/';
    protected $perms = 'master-training';

    protected $questionStruct = [
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
            'data' => 'question',
            'name' => 'question',
            'label' => 'Question',
            'searchable' => false,
            'sortable' => true,
            'className' => "left aligned",
        ],
        [
            'data' => 'action',
            'name' => 'action',
            'label' => 'Action',
            'searchable' => false,
            'sortable' => false,
            'className' => "center aligned single lined",
            'width' => '150px',
        ]
    ];

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Training");
        // $this->setSubtitle("Manage Training Course");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Training' => '#']);

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
                'data' => 'title',
                'name' => 'title',
                'label' => 'Training Title',
                'searchable' => false,
                'sortable' => true,
                'className' => "left aligned",
            ],
            [
                'data' => 'type.name',
                'name' => 'type.name',
                'label' => 'Training Type',
                'searchable' => false,
                'sortable' => true,
                'className' => "left aligned",
            ],
            [
                'data' => 'company.name',
                'name' => 'company.name',
                'label' => 'Company',
                'searchable' => false,
                'sortable' => true,
                'className' => "left aligned",
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'label' => 'Status',
                'searchable' => false,
                'sortable' => false,
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

  public function grid(Request $request)
	{

  		$records = Quiz::with('creator', 'type', 'company')->whereIn('site_id', auth()->user()->site->pluck('id')->toArray())->select('*');
  		//Init Sort
          if (!isset(request()->order[0]['column'])) {
              $records->orderBy('created_at', 'desc');
          }

  		//Filters
  		if ($type_training_id = $request->type) {
  			$records->where('type_training_id', $type_training_id);
  		}
  		if ($title = $request->title) {
  			$records->where('title', 'like' ,'%'.$title.'%');
  		}

  		$link = $this->link;

  		return DataTables::of($records)
  		->addColumn('num', function ($record) use ($request) {
  			return $request->get('start');
  		})
  		->addColumn('created_at', function ($record) {
  		  	return $record->created_at->diffForHumans();
  		})
  		->addColumn('created_by', function ($record) {
  		  	return $record->entryBy();
  		})
  		->addColumn('status', function ($record) {
  		  	return $record->published == 1 ? '<a class="ui black tag label">On Publish</a>':'<a class="ui red tag label">Draft</a>';
  		})
  		->addColumn('action', function ($record) use ($link) {
  	  		$btn = '';
  		 	//Edit

  		    $btn .= $this->makeButton([
  		      'url' => url($this->link.'manage-quiz/'.$record->id),
  		      'type' => 'default',
  		      'class' => 'teal icon',
  		      'tooltip' => 'Manage question for this training',
  		      'label' => '<i class="list icon"></i>',
  		      'id'   => $record->id
  		    ]);

  		    // Delete
              if($record->published == 0)
              {
                  $btn .= $this->makeButton([
                      'url' => url($this->link.'edit-quiz/'.$record->id),
                      'disabled' => auth()->user()->can($this->perms.'-edit'),
                      'type' => 'default',
                      'class' => 'primary icon',
                      'tooltip' => 'Edit Data',
                      'label' => '<i class="edit icon"></i>',
                      'id'   => $record->id
                  ]);
                  $btn .= "<button type='button' data-content='Delete Data' onclick=\"deleteQuiz('".url($link.'delete-quiz/'.$record->id)."')\"
                  class='ui mini red icon ".(isset($this->perms) && $this->perms != '' && !auth()->user()->can($this->perms.'-delete') ? 'disabled' : '')." button'><i class='trash icon'></i></button>\n";

                  if($record->question->count() > 0)
                  {
                      $btn .= "<button type='button'
                                data-content='Publish this quiz'
                                onclick=\"publishedQuiz('".url($link.'published-quiz/'.$record->id)."')\"
                                class='ui mini black icon ".($record->created_by != auth()->user()->id ? 'disabled' : '')." button'><i class='share icon'></i></button>\n";
                  }else {
                      $btn .= "<button type='button' data-content='Create minimum 1 question to publish this training' class='ui mini black icon button'><i class='share icon'></i></button>\n";
                  }

              }

            	return $btn;
  		})
  		->rawColumns(['action', 'contents','status'])
  		->make(true);
	}

    public function gridQuestion(Request $request)
	{
		$records = Question::with('creator')->where('quiz_id', $request->quiz_id)->select('*');
		//Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'asc');
        }

		//Filters
		if ($search = $request->search) {
			$records->where('question', 'like', '%'.$search.'%' );
		}
		$link = $this->link;

		return DataTables::of($records)
		->addColumn('num', function ($record) use ($request) {
			return $request->get('start');
		})
		->addColumn('created_at', function ($record) {
		  	return $record->created_at->diffForHumans();
		})
		->addColumn('created_by', function ($record) {
		  	return $record->entryBy();
		})
		->addColumn('action', function ($record) use ($link) {
	  		$btn = '';
		 	//Edit
      if($record->quiz->published == 0)
      {
        $btn .= $this->makeButton([
          'url' => url($this->link.'edit-question/'.$record->id),
          'disabled' => auth()->user()->can($this->perms.'-edit'),
          'type' => 'default',
          'class' => 'primary icon',
          'tooltip' => 'Manage question for this training',
          'label' => '<i class="edit icon"></i>',
          'id'   => $record->id
        ]);
        // Delete
        $btn .= "<button type='button' onclick=\"deleteQuiz('".url($link.'delete-question/'.$record->id)."')\"
        class='ui mini red icon ".(isset($this->perms) && $this->perms != '' && !auth()->user()->can($this->perms.'-delete') ? 'disabled' : '')." button'><i class='trash icon'></i></button>\n";
      }else{
          $btn .= $this->makeButton([
            'url' => url($this->link.'show-question/'.$record->id),
            'disabled' => false,
            'type' => 'default',
            'class' => 'primary icon',
            'tooltip' => 'Show question for this training',
            'label' => '<i class="eye icon"></i>',
            'id'   => $record->id
          ]);
      }


		  	return $btn;
		})
		->rawColumns(['action', 'contents'])
		->make(true);
	}

	public function index()
	{
		return $this->render('modules.master.training.index', [
		  'mockup' => false,
		]);
	}

	public function create()
	{
    $this->setTitle("Create New Course");
    // $this->setSubtitle("Manage Training Course");
    $this->setModalSize("mini");
    $this->setBreadcrumb(['Master' => '#', 'Training' => '#', 'Create' => '#']);

		return $this->render('modules.master.training.create-quiz');
	}

    public function store(CourseRequest $request)
    {
        try {
            $record = new Course;
            $record->fill($request->all());
            $record->save();

            $record->users()->sync($request->participant);
            $record->sendMailNotif();
            Trail::log('Master '.$this->getTitle(), 'created course', request()->ip(), auth()->user()->id);
        } catch (Exception $e) {
            return response([
                'status' => false,
                'errors' => $e
            ]);
        }

        return response([
            'status' => true
        ]);
    }

	public function edit($id)
	{
        $this->setTitle("Edit Course");
        // $this->setSubtitle("Manage Training Course");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Training' => '#', 'Edit Course' => '#']);

	      return $this->render('modules.master.training.edit', [
            'record' => Course::find($id),
        ]);
	}

    public function update(CourseRequest $request)
    {
        try {
            $record = Course::find($request->id);
            $record->refile($request);
            $record->fill($request->all());
            $record->save();

            $record->users()->sync($request->participant);
            Trail::log('Master '.$this->getTitle(), 'edited course', request()->ip(), auth()->user()->id);
        } catch (Exception $e) {
            return response([
                'status' => false,
                'errors' => $e
            ]);
        }

        return response([
            'status' => true
        ]);
    }

	public function manageCourse($id)
	{
        $this->setTitle("Manage Course");
        // $this->setSubtitle("Manage Training Course");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Training' => '#', 'Course' => '#', 'Manage' => '#']);
        $record = Course::find($id);

		return $this->render('modules.master.training.manage-course', [
            'record' => $record,
            'users' => $record->users()->paginate(30),
            'quizStruct' => $this->quizStruct,
        ]);
	}

	public function manageQuiz($id)
	{
        $this->setTitle("Manage Quiz");
        // $this->setSubtitle("Manage Training Course");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Training' => '#', 'Course' => '#', 'Manage Quiz' => '#']);
        $record = Quiz::find($id);

		return $this->render('modules.master.training.manage-quiz', [
            'record' => $record,
            'users' => $record->users()->paginate(30),
            'questionStruct' => $this->questionStruct,
        ]);
	}

	public function createQuiz($id)
	{
        $this->setTitle("Create Training");
        // $this->setSubtitle("Manage Training Course");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Training' => '#', 'Course' => '#', 'Create Training' => '#']);

		return $this->render('modules.master.training.create-quiz', [
            'record' => Course::find($id),
        ]);
	}

	public function createQuestion($id)
	{
        $this->setTitle("Create Question");
        // $this->setSubtitle("Manage Training Course");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Training' => '#', 'Course' => '#', 'Quiz' => '#', 'Create Question' => '#']);

		return $this->render('modules.master.training.create-question', [
            'record' => Quiz::find($id)
        ]);
	}

	public function editQuiz($id)
	{
        $this->setTitle("Edit Training");
        // $this->setSubtitle("Manage Training Course");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Training' => '#', 'Course' => '#', 'Edit Training' => '#']);

		return $this->render('modules.master.training.edit-quiz', [
            'record' => Quiz::find($id),
        ]);
	}

	public function editQuestion($id)
	{
        $this->setTitle("Edit Question");
        // $this->setSubtitle("Manage Training Course");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Training' => '#', 'Course' => '#', 'Edit Question' => '#']);

		return $this->render('modules.master.training.edit-question', [
            'record' => Question::find($id),
        ]);
	}

	public function showQuestion($id)
	{
        $this->setTitle("Show Question");
        // $this->setSubtitle("Manage Training Course");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Training' => '#', 'Course' => '#', 'Edit Question' => '#']);

		return $this->render('modules.master.training.show-question', [
            'record' => Question::find($id),
        ]);
	}

    public function uploadQuestions(Request $request)
    {
        try {
            $url = [];
            if(count($request->picture) > 0)
            {
                $i = 0;
                foreach($request->picture as $picture)
                {
                    $get = $picture->storeAs('training/question', md5($picture->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$picture->getClientOriginalExtension(), 'public');
                    $url[$i]['url'] = asset('storage/'.$get);
                    $url[$i]['value'] = $get;

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

    public function upload(Request $request)
    {
        try {
            $url = $request->file->storeAs('training', md5($request->file->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->file->getClientOriginalExtension(), 'public');

            return response([
                'status' => true,
                'filename' => $request->file->getClientOriginalName(),
                'url' => $url,
            ]);

        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }

        return response([
            'status' => true,
        ]);
    }

    public function removefile(Request $request)
    {
        try {
            if(file_exists(storage_path().'/app/public/'.$request->fileurl))
            {
                unlink(storage_path().'/app/public/'.$request->fileurl);
            }
        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }

        return response([
            'status' => true,
        ]);
    }

    public function showUsers($id = NULL, $site_id = NULL)
    {
        $paginator = User::query();

        $request = request()->all();
        if(isset($request['name']))
        {
            $paginator->where(function ($w) use ($request) {
                $w->where('username', 'like', '%'.$request['name'].'%')->orWhere('fullname', 'like', '%'.$request['name'].'%');
            });
        }
        if(isset($request['roles']))
        {
            $paginator->whereHas('roles', function ($roles) use ($request) {
                $roles->where('id', $request['roles']);
            });
        }

        if($site_id != NULL OR isset($request['site']))
        {
            if(isset($request['site'])){
                $site_id = $request['site'];
            }
            $paginator->whereHas('site', function ($site) use ($site_id) {
                $site->where('id', $site_id);
            });
        }

        $result = $paginator->paginate(30);
        $data['users'] = $result;

        $data['record'] = Course::find($id);
        return view('modules.master.training.users.create', $data);
    }

    public function showUsersCourse($id = NULL)
    {
        if($id != NULL || $id != 0)
        {
            $paginator = Course::find($id)->users();
        }else{
            $paginator = User::query();
        }

        $request = request()->all();
        if(isset($request['name']))
        {
            $paginator->where(function ($w) use ($request) {
                $w->where('username', 'like', '%'.$request['name'].'%')->orWhere('fullname', 'like', '%'.$request['name'].'%');
            });
        }
        if(isset($request['roles']))
        {
            $paginator->whereHas('roles', function ($roles) use ($request) {
                $roles->where('id', $request['roles']);
            });
        }
        if(isset($request['site']))
        {
            $paginator->whereHas('site', function ($site) use ($request) {
                $site->where('id', $request['site']);
            });
        }
        $result = $paginator->paginate(30);
        $data['users'] = $result;

        $data['record'] = Course::find($id);
        return view('modules.master.training.users.create', $data);
    }

    public function showUsersQuiz($id = NULL)
    {
        if($id != NULL || $id != 0)
        {
            $paginator = User::query();
        }else{
            $paginator = User::query();
        }

        $request = request()->all();
        if(isset($request['name']))
        {
            $paginator->where(function ($w) use ($request) {
                $w->where('username', 'like', '%'.$request['name'].'%')->orWhere('fullname', 'like', '%'.$request['name'].'%');
            });
        }
        if(isset($request['roles']))
        {
            $paginator->whereHas('roles', function ($roles) use ($request) {
                $roles->where('id', $request['roles']);
            });
        }
        if(isset($request['site']))
        {
            $paginator->whereHas('site', function ($site) use ($request) {
                $site->where('id', $request['site']);
            });
        }
        $result = $paginator->paginate(30);
        $data['users'] = $result;

        $data['record'] = Quiz::find($id);

        return view('modules.master.training.users.create', $data);
    }

    public function checkAll($id = NULL, $site_id = NULL)
    {
        $users = User::get();

        if($site_id != NULL)
        {
            $users = User::whereHas('site', function ($site) use ($site_id) {
                $site->where('id', $site_id);
            })->get();
        }

        if($id != NULL)
        {
            if($id > 0)
            {
              $users = Course::find($id)->users;
            }
        }

        return view('modules.master.training.users.checked', [
            'users' => $users
        ]);
    }

    public function checkAllQuiz($id = NULL)
    {
        $users = User::get();
        if($id != NULL)
        {
            $users = Quiz::find($id)->users;
        }

        return view('modules.master.training.users.checked', [
            'users' => $users
        ]);
    }

    public function storeQuiz(QuizRequest $request)
    {
        try {
            $record = new Quiz;
            $fileurl = $request->fileurl;
            $filename = $request->filename;
            $request['fileurl'] = NULL;
            $request['filename'] = NULL;
            $record->fill($request->all());
            $record->save();

            if((isset($fileurl) AND (count($fileurl) > 0)))
            {
                foreach($fileurl as $key => $fl)
                {
                      $file = new QuizFiles;
                      $file->quiz_id = $record->id;
                      $file->fileurl = $fl;
                      $file->filename = $filename[$key];
                      $file->save();
                }
            }

            $record->users()->sync($request->participant);
            Trail::log('Master '.$this->getTitle(), 'created quiz', request()->ip(), auth()->user()->id);

        } catch (Exception $e) {
            return response([
                'status' => false,
                'errors' => $e
            ]);
        }

        return response([
            'status' => true,
            // 'url' => url($this->link.'manage-course/'.$request->course_id)
        ]);
    }

    public function updateQuiz(QuizRequest $request)
    {
        try {
            $record = Quiz::find($request->id);

            $fileurl = $request->fileurl;
            $filename = $request->filename;
            $request['fileurl'] = NULL;
            $request['filename'] = NULL;
            if($fileurl)
            {
              if(count($fileurl) > 0)
              {
                  foreach($fileurl as $key => $fl)
                  {
                        $file = new QuizFiles;
                        $file->quiz_id = $record->id;
                        $file->fileurl = $fl;
                        $file->filename = $filename[$key];
                        $file->save();
                  }
              }
            }

            $record->fill($request->all());
            $record->save();

            $record->users()->sync($request->participant);
            Trail::log('Master '.$this->getTitle(), 'edited quiz', request()->ip(), auth()->user()->id);

        } catch (Exception $e) {
            return response([
                'status' => false,
                'errors' => $e
            ]);
        }

        return response([
            'status' => true,
        ]);
    }

    public function destroy($id)
    {
        try {
            $record = Course::find($id);
            $record->removefile();

            $record->users()->detach();

            $record->quiz()->each(function ($quiz) {
                  $quiz->question()->each(function ($question) {
                        if($question->images->count() > 0)
                        {
                          foreach($question->images as $image)
                          {
                              if(file_exists(storage_path().'/app/public/'.$image->filepath))
                              {
                                  unlink(storage_path().'/app/public/'.$image->filepath);
                              }
                          }
                        }
                        QuestionImage::where('question_id', $question->id)->delete();
                        $question->answer()->delete();
                  });
                  $quiz->users()->detach();
                  $quiz->quizAnswer()->delete();
            });

            $record->quiz()->delete();
            $record->delete();
            Trail::log('Master '.$this->getTitle(), 'deleted course', request()->ip(), auth()->user()->id);

            return response([
                'status' => true,
            ]);
        } catch (Exception $e) {
            return response([
                'status' => false,
                'data' => $e
            ]);
        }
    }

    public function publishedQuiz($id)
    {
        try {
            $record = Quiz::find($id);
            $record->published = 1;
            $record->save();

            Trail::log('Master '.$this->getTitle(), 'published quiz', request()->ip(), auth()->user()->id);

            if($record->users->count() > 0)
            {
                foreach($record->users as $user)
                {
                    $n['modul'] = 'Training/SHE Training Online';
                    $n['url'] = url('training/show-quiz/'.$record->id);
                    $n['fullurl'] = url('training/show-quiz/');

                    $n['user_id'] = $user->id;
                    $n['form_type'] = 'training';
                    $n['form_id'] = $record->id;
                    $n['content'] = 'There is new Quiz for you to take';

                    $notification = new Notification;
                    $notification->fill($n);
                    $notification->save();
                }

            }

            return response([
                'status' => true,
            ]);
        } catch (Exception $e) {
            return response([
                'status' => false,
                'data' => $e
            ]);
        }
    }

    public function destroyQuiz($id)
    {
        try {
            $record = Quiz::find($id);
            $record->removefile();
            $record->delete();
            Trail::log('Master '.$this->getTitle(), 'deleted quiz', request()->ip(), auth()->user()->id);

            return response([
                'status' => true,
            ]);
        } catch (Exception $e) {
            return response([
                'status' => false,
                'data' => $e
            ]);
        }
    }

    public function destroyQuestion($id)
    {
        try {
            $record = Question::find($id);
            $record->removeImages();
            $record->delete();
            Trail::log('Master '.$this->getTitle(), 'deleted question', request()->ip(), auth()->user()->id);

            return response([
                'status' => true,
            ]);
        } catch (Exception $e) {
            return response([
                'status' => false,
                'data' => $e
            ]);
        }
    }

    public function storeQuestion(QuestionRequest $request)
    {
        try {
            $record = new Question;
            $record->fill($request->all());
            $record->save();

            $record->saveImage($request->filespath);
            $record->saveAnswer($request);
            Trail::log('Master '.$this->getTitle(), 'created question', request()->ip(), auth()->user()->id);

        } catch (Exception $e) {
            return response([
                'status' => false,
                'errors' => $e
            ]);
        }

        return response([
            'status' => true,
            'url' => url($this->link.'manage-quiz/'.$request->quiz_id)
        ]);
    }

    public function updateQuestion(QuestionRequest $request)
    {
        try {
            $record = Question::find($request->id);
            $record->fill($request->all());
            $record->save();

            $record->updateImage($request);
            $record->updateAnswer($request);
            Trail::log('Master '.$this->getTitle(), 'edited question', request()->ip(), auth()->user()->id);

        } catch (Exception $e) {
            return response([
                'status' => false,
                'errors' => $e
            ]);
        }

        return response([
            'status' => true,
            'url' => url($this->link.'manage-quiz/'.$record->quiz_id)
        ]);
    }

    public function unlink(Request $request)
    {
        try {
            $data = QuestionImage::where('question_id', $request->question_id)->where('filepath', $request->path)->first();
            if(file_exists(storage_path().'/app/public/'.$request->path))
            {
                unlink(storage_path().'/app/public/'.$request->path);
            }
            $data = QuestionImage::where('question_id', $request->question_id)->where('filepath', $request->path)->delete();

            return response([
                'status' => true,
            ]);

        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }
    }

    public function ImagesExistUploads(Request $request)
    {
        try {
            $url = [];
            if(count($request->picture) > 0)
            {
                $i = 0;
                foreach($request->picture as $picture)
                {
                    $get = $picture->storeAs('training/question', md5($picture->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$picture->getClientOriginalExtension(), 'public');
                    $rec['question_id'] = $request->question_id;
                    $rec['filepath'] = $get;

                    $url[$i]['url'] = asset('storage/'.$get);
                    $url[$i]['value'] = $get;

                    // $save = new QuestionImage;
                    // $save->fill($rec);
                    // $save->save();

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

    public function unlinkFile($id)
    {
        try {
            $data = QuizFiles::find($id);

            if(file_exists(storage_path().'/app/public/'.$data->fileurl))
            {
                unlink(storage_path().'/app/public/'.$data->fileurl);
            }
            $data->delete();

            return response([
                'status' => true,
            ]);

        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }

    }
}
