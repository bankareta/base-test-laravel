<?php
namespace App\Http\Requests\Documents;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use App\Models\Document\Documents;

class DocumentsRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
      $request = $this;
      if($this->get('id')){
        if($this->get('filess')){
          $record = Documents::where('name',$request->name)->where('parent_id', $request->idsebelumnya)->where('filename','!=',null)->get();
          if($record->count() > 1){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'errors' => array("name" => ["There is the same data on File Name"]))));
          }
          $rules = [
              'name' => 'required|max:185',
              'site_id' => 'required',
          ];
        }else{
          $record = Documents::where('name',$request->name)->where('parent_id', $request->idsebelumnya)->where('filename','=',null)->get();
          if($record->count() > 1){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'errors' => array("name" => ["There is the same data on File Name"]))));
          }
          $rules = [
            'name' => 'required|max:185',
            'site_id' => 'required',
          ];
        }
      }else{
        if($this->get('filess')){
          $record = Documents::where('name',$request->name)->where('parent_id', $request->idsebelumnya)->where('filename','!=',null)->get();
          if($record->count() > 0){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'errors' => array("name" => ["There is the same data on File Name"]))));
          }
          $rules = [
              'name' => 'required|max:185',
              'site_id' => 'required',
          ];
        }else{
           $record = Documents::where('name',$request->name)->where('parent_id', $request->idsebelumnya)->where('filename','=',null)->get();
          if($record->count() > 0){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'errors' => array("name" => ["There is the same data on File Name"]))));
          }
          $rules = [
            'name' => 'required|max:185',
            'site_id' => 'required',
          ];
        }
      }
        return $rules;
    }
    public function attributes()
    {
       return [
           'no_gangguan' => 'No. Gangguan',
           'rayon_id' => 'Rayon',
           'area_id' => 'Area',
           'site_id' => 'Company',
       ];
    }

    public function messages()
    {
        return [
            'unique_with' => 'There is the same data on Company',
            'max' => 'Sentence length cannot exceed :max characters',
            'required' => 'The data cannot be empty'
        ];
    }
}
