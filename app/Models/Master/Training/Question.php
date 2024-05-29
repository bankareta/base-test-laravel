<?php

namespace App\Models\Master\Training;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Authentication\User;
use File;
use Helpers;

class Question extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

	/* default */
    protected $table 		= 'ref_question';
    protected $fillable = [
        'quiz_id',
        'question',
        'type_answer'
    ];
	/* relation */
	// insert code here

    public function answer()
    {
      return $this->hasMany(Answer::class, 'question_id');
    }

    public function images()
    {
        return $this->hasMany(QuestionImage::class, 'question_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

	/* mutator */
	// insert code here



	/* scope */
	// insert code here


	/* custom function */

    public function saveAnswer($request)
    {
        if($request->answer)
        {
            foreach($request->answer as $key => $answer)
            {
                $record = new Answer;
                $save['question_id'] = $this->id;
                $save['answer'] = $answer;
                $save['number'] = $key;
                if($request->true == $key)
                {
                    $save['true'] = 1;
                }else{
                    $save['true'] = 0;
                }

                $record->fill($save);
                $record->save();
            }
        }
    }

    public function updateAnswer($request)
    {

        if($request->answer)
        {
            $i = 0;
            foreach($request->answer as $key => $answer)
            {
                $i++;
                $record = Answer::find($key);
                $save['question_id'] = $this->id;
                $save['answer'] = $answer;
                $save['number'] = $i;
                if($request->true == $i)
                {
                    $save['true'] = 1;
                }else{
                    $save['true'] = 0;
                }

                $record->fill($save);
                $record->save();
            }
        }
    }

    public function showTrue($number)
    {
        if($this->answer->count() > 0)
        {
            if($this->answer->where('number', $number)->first())
            {
                return $this->answer->where('number', $number)->first()->true;
            }
        }
    }

    public function showAnswer($number)
    {
        if($this->answer->count() > 0)
        {
            if($this->answer->where('number', $number)->first())
            {
                return $this->answer->where('number', $number)->first()->answer;
            }
        }
    }

    public function showId($number)
    {
        if($this->answer->count() > 0)
        {
            if($this->answer->where('number',$number)->first())
            {

                return $this->answer->where('number', $number)->first()->id;
            }
        }
    }

    public function showNumber($number)
    {
        if($this->answer->count() > 0)
        {
            if($this->answer->where('number',$number)->first())
            {

                return $this->answer->where('number', $number)->first()->number;
            }
        }
    }

    public function saveImage($filespath)
    {

        $reporting = QuestionImage::where('question_id', $this->id)->whereNotIn('filepath', [$filespath])->get();

        if($reporting->count() > 0)
        {
            foreach($reporting as $image)
            {
                if(file_exists(storage_path().'/app/public/'.$image->filepath))
                {
                    unlink(storage_path().'/app/public/'.$image->filepath);
                }
            }
        }
        $reporting = QuestionImage::where('question_id', $this->id)->whereNotIn('filepath', [$filespath])->delete();

        if($filespath)
        {
            $this->images()->saveMany(array_map(function($item){
                return new QuestionImage(['filepath' => $item]);
            }, $filespath));
        }
    }

    public function updateImage($request)
    {

         $this->images()->delete();
            $saveFile = [];
            if(isset($request->filespathexist)){
                if(count($request->filespathexist) > 0){
                    foreach ($request->filespathexist as $value) {
                        $saveFile['filepath'] = $value;
                        $saveFile['question_id'] = $this->id;
                        $recordFile = new QuestionImage;
                        $recordFile->fill($saveFile);
                        $recordFile->save();
                    }
                }
            }

            if(isset($request->filespath)){
                if(count($request->filespath) > 0){
                    foreach ($request->filespath as $value) {
                        $saveFilePath['filepath'] = $value;
                        $saveFilePath['question_id'] = $this->id;
                        $recordFile = new QuestionImage;
                        $recordFile->fill($saveFilePath);
                        $recordFile->save();
                    }
                }
            }
    }

    public function removeImages()
    {
        if($this->images->count() > 0)
        {
            foreach($this->images as $image)
            {
                if($image->filepath)
                {
                    if(file_exists(storage_path().'/app/public/'.$image->filepath))
                    {
                        unlink(storage_path().'/app/public/'.$image->filepath);
                    }
                }

            }
        }
    }

    public function showCardImages($stt = null)
    {
        $return = '';
        $deleteBut = '';
        $style = '';
        if($stt == null){
            $deleteBut = '<div class="ui bottom attached red mfs remove pictureexist button">
                    <i class="trash icon"></i>
                    Remove Evidence
                </div>';
            $style = 'style="height:120px !important;"';
        }
        if($this->images->count() > 0)
        {
            foreach($this->images as $images)
            {
                $return .= '<div class="small card">
                            <a class="image" href="'.asset('storage/'.$images->filepath).'" target="_blank">
                                <img src="'.asset('storage/'.$images->filepath).'"'.$style.'>
                            </a>
                            <input type="hidden" class="mfs path hidden input" name="filespathexist[]" value="'.$images->filepath.'">
                            '.$deleteBut.'
                          </div>';
            }
        }

        return $return;
    }


}
