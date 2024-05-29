<?php

namespace App\Models\Master\Training;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Authentication\User;
use App\Models\Training\QuizAnswer;
use App\Models\Master\TypeTraining;
use App\Models\Master\Site;

use File;
use Helpers;

class QuizFiles extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

	/* default */
    protected $table 		= 'ref_quiz_files';
    protected $fillable = [
        'filename',
        'fileurl',
        'quiz_id'
    ];

	/* relation */
	// insert code here

    public function quiz()
    {
      return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function getEmbedFile($centered = 'centered')
    {
        if($this->fileurl != NULL)
        {
            $ext = File::extension(storage_path().'/app/public/'.$this->fileurl);

            if(file_exists(storage_path().'/app/public/'.$this->fileurl))
            {
                switch($ext)
                {
                    case 'ppt':
                    return '
                    <div class="small card">
                    <div class="blurring dimmable image">
                    <div class="ui dimmer">
                    <div class="content">
                    <div class="center">
                    <a href="'.url('download-file/'.base64_encode($this->fileurl)).'" download="'.$this->filename.'" target="_blank" class="ui inverted massive blue icon button"><i class="download icon"></i></a>
                    </div>
                    </div>
                    </div>
                    <img src="'.asset('img/powerpoint.png').'">
                    <div class="ui bottom attached button">
                                Training File
                            </div>
                    </div>
                    </div>
                    ';
                    break;
                    case 'pptx':
                    return '
                    <div class="small card">
                    <div class="blurring dimmable image">
                    <div class="ui dimmer">
                    <div class="content">
                    <div class="center">
                    <a href="'.url('download-file/'.base64_encode($this->fileurl)).'" download="'.$this->filename.'" target="_blank" class="ui inverted massive blue icon button"><i class="download icon"></i></a>
                    </div>
                    </div>
                    </div>
                    <img src="'.asset('img/powerpoint.png').'">
                    <div class="ui bottom attached button">
                                Training File
                    </div>
                    </div>
                    </div>
                    ';
                    break;
                    case 'xlsx':
                    return '
                    <div class="small card">
                        <div class="blurring dimmable image">
                            <div class="ui dimmer">
                                <div class="content">
                                    <div class="center">
                                        <a href="'.url('download-file/'.base64_encode($this->fileurl)).'" download="'.$this->filename.'" target="_blank" class="ui inverted massive blue icon button"><i class="download icon"></i></a>
                                    </div>
                                </div>
                            </div>
                            <img src="'.asset('img/xlsx.png').'">
                            <div class="ui bottom attached button">
                                Training File
                            </div>
                        </div>
                    </div>
                    ';
                    break;
                    case 'xls':
                    return '
                    <div class="small card">
                    <div class="blurring dimmable image">
                    <div class="ui dimmer">
                    <div class="content">
                    <div class="center">
                    <a href="'.url('download-file/'.base64_encode($this->fileurl)).'" download="'.$this->filename.'" target="_blank" class="ui inverted massive blue icon button"><i class="download icon"></i></a>
                    </div>
                    </div>
                    </div>
                    <img src="'.asset('img/xls.png').'">
                    <div class="ui bottom attached button">
                                Training File
                            </div>
                    </div>
                    </div>
                    ';
                    break;
                    case 'pdf':
                    return '
                    <div class="small card">
                        <div class="blurring dimmable image">
                            <div class="ui dimmer">
                                <div class="content">
                                    <div class="center">
                                        <a onclick="loadPdfModal(this)" href="javascript:void(0)" data-pdf="'.asset('storage/'.$this->fileurl).'" class="ui inverted massive blue icon button"><i class="eye icon"></i></a>
                                    </div>
                                </div>
                            </div>
                            <img src="'.asset('img/pdf.png').'">
                            <div class="ui bottom attached button">
                                Training File
                            </div>
                        </div>
                    </div>
                    ';
                    break;
                    // return '<embed src="'.asset('storage/'.$this->fileurl).'" width="500" height="375" type="application/pdf">';
                    break;
                    case 'mp4':
                    return '
                    <div class="small card">
                        <div class="blurring dimmable image">
                            <div class="ui dimmer">
                                <div class="content">
                                    <div class="center">
                                        <a onclick="loadModalVideo(this)" href="javascript:void(0)" data-video="'.asset('storage/'.$this->fileurl).'" class="ui inverted massive blue icon button"><i class="eye icon"></i></a>
                                    </div>
                                </div>
                            </div>
                            <img src="'.asset('img/video.png').'">
                            <div class="ui bottom attached button">
                                Training File
                            </div>
                        </div>
                    </div>
                    ';
                    break;
                    case 'png':
                    return '<div class="ui small card">
                    <a class="image" href="'.asset('storage/'.$this->fileurl).'" download="'.$this->filename.'" target="_blank" style="height: 181px;">
                    <img src="'.asset('storage/'.$this->fileurl).'" style="height: 150px;">
                    <div class="ui bottom attached button">
                        Training File
                    </div>
                    </a>
                    </div>
                    ';
                    break;
                    case 'jpg':
                    return '<div class="ui small card">
                    <a class="image" href="'.asset('storage/'.$this->fileurl).'" download="'.$this->filename.'" target="_blank" style="height: 181px;">
                    <img src="'.asset('storage/'.$this->fileurl).'" style="height: 150px;">
                    </a>
                    <div class="ui bottom attached button">
                                Training File
                            </div>
                    </div>
                    ';
                    break;
                    case 'jpeg':
                    return '<div class="ui small card">
                    <a class="image" href="'.asset('storage/'.$this->fileurl).'" download="'.$this->filename.'" target="_blank" style="height: 181px;">
                    <img src="'.asset('storage/'.$this->fileurl).'" style="height: 150px;">
                    <div class="ui bottom attached button">
                        Training File
                    </div>
                    </a>
                    </div>
                    ';
                    break;
                    default:
                    return '
                    <div class="small card">
                    <div class="blurring dimmable image">
                    <div class="ui dimmer">
                    <div class="content">
                    <div class="center">
                    <a href="'.url('download-file/'.base64_encode($this->fileurl)).'" download="'.$this->filename.'" target="_blank" class="ui inverted massive blue icon button"><i class="download icon"></i></a>
                    </div>
                    </div>
                    </div>
                    <img src="'.asset('img/xls.png').'">
                    <div class="ui bottom attached button">
                                Training File
                            </div>
                    </div>
                    </div>
                    ';
                    break;
                }
            }
        }
    }


}
