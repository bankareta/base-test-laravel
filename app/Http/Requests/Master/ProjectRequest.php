<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class ProjectRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'type_project' => 'required',
            'project_number' => 'required|max:185|unique:ref_project,project_number,'.$this->get('id'),
            'project' => 'required|max:185|unique_with:ref_project,type_project,'.$this->get('id'),
        ];

        return $rules;
    }
    public function attributes()
    {
       return [

       ];
    }

}
