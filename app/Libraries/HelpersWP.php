<?php
namespace App\Libraries;

use Carbon\Carbon;

class HelpersWP
{
	public static function itemInspected(){
		return [
			'TUBES',
			'FRAMES',
			'BASES',
			'LADDERS',
			'ACCESS',
			'PLANKS',
			'KICK BOARDS',
			'HAND RAILS',
			'TIE OFFS',
			'FALGGING',
			'SIGNS',
			'BARRICADES',
			'LIGHTING',
			'TAGGED',
		];
	}

	public static function getOneItem($bulan) {
        $blnInt = '-';
        switch ($bulan)
        {
            case 0: $blnInt = 'TUBES';
            break;
            case 1: $blnInt = 'FRAMES';
            break;
            case 2: $blnInt = 'BASES';
            break;
            case 3: $blnInt = 'LADDERS';
            break;
            case 4: $blnInt = 'ACCESS';
            break;
            case 5: $blnInt = 'PLANKS';
            break;
            case 6: $blnInt = 'KICK BOARDS';
            break;
            case 7: $blnInt = 'HAND RAILS';
            break;
            case 8: $blnInt = 'TIE OFFS';
            break;
            case 9: $blnInt = 'FALGGING';
            break;
            case 10: $blnInt = 'SIGNS';
            break;
            case 11: $blnInt = 'BARRICADES';
            break;
            case 12: $blnInt = 'LIGHTING';
            break;
            case 13: $blnInt = 'TAGGED';
            break;
        }

        return $blnInt;
    }

    public static function jsaChecklist(){
        
        $array = array(
            array(
                'value' => 'Required Permits',
                'key' => '#0',
                'sub' => ['General Work Permit (GWP)','Confined Space Permit','Excavation Permit','Loto','Hot Work Permit','Others <br><br><input type="text" placeholder="Others" name="checklist[6][deskripsi]">']
            ),
            array(
                'value' => 'Head, Eye & Face Protection',
                'key' => '#1',
                'sub' => ['Hard Halt / Helmet','Safety Glases','Face Shield','Safety Goggles','Welding Hoold']
            ),
            array(
                'value' => 'Hand & Arms Protection',
                'key' => '#2',
                'sub' => ['Cotton Gloves / Polkadot','Cut Resistence Gloves','Nitrile Gloves','Surgical Gloves','Rubber Gloves', 'Long Arm Sleeves', 'Lether Gloves (Welding)']
            ),
            array(
                'value' => 'Body Protection',
                'key' => '#3',
                'sub' => ['Cotton Coveralls','Tyvek / Poly Coated Tyvek','Safety Vest','Full Body Harness & Lanyard','Saranex', 'Appron']
            ),
            array(
                'value' => 'Foot Protection',
                'key' => '#4',
                'sub' => ['Sturdy Work Boots','Safety Steel Toed Body','Rubber Boots','Rubber Boot Covers']
            ),
            array(
                'value' => 'Respiratory',
                'key' => '#5',
                'sub' => ['Dusk Mask','Air Purifying','SCBA / Supplied Air']
            ),
        );

        return $array;
    }

    public static function getSub($data = null){
        $get = '-';
        if($data != null){
             switch ($data)
            {
                case '#0': $get = 'Required Permits';
                break;
                case '#1': $get = 'Head, Eye & Face Protection';
                break;
                case '#2': $get = 'Hand & Arms Protection';
                break;
                case '#3': $get = 'Body Protection';
                break;
                case '#4': $get = 'Foot Protection';
                break;
                case '#5': $get = 'Respiratory';
                break;
            }

        }

        return $get;
    }

    public static function getChild($nasi = null, $kopi = null, $value = null){
        $get = '-';
        if($nasi == '#0'){
             switch ($kopi)
            {
                case '0': $get = 'General Work Permit (GWP)';
                break;
                case '1': $get = 'Confined Space Permit';
                break;
                case '2': $get = 'Excavation Permit';
                break;
                case '3': $get = 'Loto';
                break;
                case '4': $get = 'Hot Work Permit';
                break;
                case '5': $get = 'Others <br><br><input type="text" placeholder="Others" name="checklist[6][deskripsi]" value="'.$value.'">';
                break;
            }
        }else if($nasi == '#1'){
             switch ($kopi)
            {
                case '0': $get = 'Hard Halt / Helmet';
                break;
                case '1': $get = 'Safety Glases';
                break;
                case '2': $get = 'Face Shield';
                break;
                case '3': $get = 'Safety Goggles';
                break;
                case '4': $get = 'Welding Hoold';
                break;
            }
        }else if($nasi == '#2'){
             switch ($kopi)
            {
                case '0': $get = 'Cotton Gloves / Polkadot';
                break;
                case '1': $get = 'Cut Resistence Gloves';
                break;
                case '2': $get = 'Nitrile Gloves';
                break;
                case '3': $get = 'Surgical Gloves';
                break;
                case '4': $get = 'Rubber Gloves';
                break;
                case '5': $get = 'Long Arm Sleeves';
                break;
                case '6': $get = 'Lether Gloves (Welding)';
                break;
            }
        }else if($nasi == '#3'){
             switch ($kopi)
            {
                case '0': $get = 'Cotton Coveralls';
                break;
                case '1': $get = 'Tyvek / Poly Coated Tyvek';
                break;
                case '2': $get = 'Safety Vest';
                break;
                case '3': $get = 'Full Body Harness & Lanyard';
                break;
                case '4': $get = 'Saranex';
                break;
                case '5': $get = 'Appron';
                break;
            }
        }else if($nasi == '#4'){
             switch ($kopi)
            {
                case '0': $get = 'Sturdy Work Boots';
                break;
                case '1': $get = 'Safety Steel Toed Body';
                break;
                case '2': $get = 'Rubber Boots';
                break;
                case '3': $get = 'Rubber Boot Covers';
                break;
            }
        }else if($nasi == '#5'){
             switch ($kopi)
            {
                case '0': $get = 'Dusk Mask';
                break;
                case '1': $get = 'Air Purifying';
                break;
                case '2': $get = 'SCBA / Supplied Air';
                break;
               
            }
        }

        return $get;
    }

    public static function getNatureHz(){
        return [
            'Stored energy (steam, pressure, electrical)',
            'Noise',
            'Toxic substance',
            'Heat',
            'Elevation',
            'Traffic',
            'Flammable Vapors',
            'Ignition Source',
            'Restricted access',
            'Other ',
        ];
    }

    public static function getPrecautions(){
        return [
            'Isolations in Place',
            'Ventilation',
            'Crew Rotation',
            'Life Lines Installed',
            'Roads Closed',
            'Mats Installed',
            'Combustibles Removed',
            'Drains covered',
            'Materials Drained',
            'Ground Fault Circuit Interrupter',
            'MSDS available',
            'Scaffolding Inspected',
            'Emergency Station',
            'Others Precautions',


        ];
    }

    public static function PPE(){
        
        $array = array(
            array(
                'value' => 'Eye / Ear',
                'key' => '#0',
                'sub' =>[
                            'Goggles',
                            'Safety Glasses',
                            'Face Shield',
                            'Earplug',
                            'Muffs',
                        ]
            ),
            array(
                'value' => 'Extremities',
                'key' => '#1',
                'sub' => [
                        'Gloves',
                        'Boots',
                        'Hard hat',
                        'Chemical Resistant',
                ]
            ),
            array(
                'value' => 'Fall Protection',
                'key' => '#2',
                'sub' => [
                        'Harness',
                        'Lifeline',
                    ]
            ),
            array(
                'value' => 'Respirator',
                'key' => '#3',
                'sub' => [
                        'SCBA',
                        'Cartridge',
                        'Dust mask',
                    ]
            ),
            
        );

        return $array;
    }


    public static function HotHazard(){
    	return [
            'Ignition source within 12 meter of fuel source',
			'Open drains with Hydrocarbons',
			'Combustibles in the Area',
			'Non Intrinsically Safe (IS)',
			'Welding process',
			'Compressed Gas Cylinders',
			'Radiation',

        ];
    }

    public static function HotPrecaution(){
    	return [
            'Charged Fire Hose',
			'Shields, Blankets',
			'Drains covered',
			'Area Wet ',
			'Fire Extinguisher',
			'Ventilation',
			'Welding Machine Grounded',
			'Welding Equipment Inspected',
			'Cylinders secured',
			'Continuous Atmospheric Monitoring',
        ];
    	
    }

     public static function HazardNature(){
        return [
            'Stored Energy (steam, pressure, electrical)',
            'Ignition Source',
            'Flammable material',
            'Explosive material',
            'Toxic substances',
            'Elevasi / Depth',
            'Noise',
            'Heat',
            'Dust',
            'Other',
        ];
        
    }

    // START CONFINED //

    public static function confinedEntry(){
        return [
            'Hazardous residue present',
            'Physical Stress (Heat/Cold)',
            'Oxygen Deficiency',
            'Noise',
            'Combustible gas/vapors',
            'Toxic gas/vapors (H2S)',
            'Chemical contact',
            'Electrical/Mechanical',
            'Vacating / Draining / Venting',
            'Flushing / Purging',
            'Area Barricaded',
            'Continuous atmospheric testing and ventilation',
            'Lighting',
            'Life lines',
            'First Aider and equipment',
            'Communication Plan Made'

        ];
        
    }
}