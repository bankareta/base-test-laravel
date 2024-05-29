<?php
namespace App\Http\Requests\RegulationsAndStandard;

use App\Http\Requests\Request;
use App\Models\Regulation\Regulations;

class RegulationsRequest extends Request
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
          $record = Regulations::where('name',$request->name)->where('filename','!=',null)->get();
          if($record->count() > 1){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'errors' => array("name" => ["There is the same data on File Name"]))));
          }
          $rules = [
            'name' => 'required|max:185',
            'type_id' => 'required',
            'site_id' => 'required',
            'kelompok' => 'required',
          ];
        }else{
          $record = Regulations::where('name',$request->name)->where('filename','=',null)->get();
          if($record->count() > 1){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'errors' => array("name" => ["There is the same data on File Name"]))));
          }
          $rules = [
            'name' => 'required|max:185',
            'type_id' => 'required',
            'site_id' => 'required',
            'kelompok' => 'required',
          ];
        }  
      }else{
        if($this->get('filess')){
          $record = Regulations::where('name',$request->name)->where('filename','!=',null)->get();
          if($record->count() > 0){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'errors' => array("name" => ["There is the same data on File Name"]))));
          }
          $rules = [
            'name' => 'required|max:185',
            'type_id' => 'required',
            'site_id' => 'required',
            'kelompok' => 'required',
          ];
        }else{
           $record = Regulations::where('name',$request->name)->where('filename','=',null)->get();
          if($record->count() > 0){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'errors' => array("name" => ["There is the same data on File Name"]))));
          }

          if($this->get('type_id')){
            $rules = [
              'name' => 'required|max:185',
              'type_id' => 'required',
              'site_id' => 'required',
              'kelompok' => 'required',
            ];
          }else{
            $rules = [
              'name' => 'required|max:185',
              'type_id_bangsat' => 'required',
              'site_id' => 'required',
              'kelompok' => 'required',
            ];
          }
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
           'type_id' => 'Type',
           'site_id' => 'Company',
           'kelompok' => 'Category',
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
