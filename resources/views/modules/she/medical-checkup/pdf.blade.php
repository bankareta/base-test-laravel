@extends('layouts.pdf')

@push('style')
    <style>
        .dont-break-me{
            page-break-inside: avoid;
        }
        small {
            font-size: 10px;
            color: grey;
        }
        .data {
            padding-left: 45px;
            padding-right: 45px;
        }
        .data td {
            font-size: 14px;
        }
        .dont-break-me td {
            font-size: 14px;
        }
        th {
            font-size: 18px;
        }
        .margin-checkbox {
            margin-top: 1.15px;
        }
        textarea {
            font-family: "Arial Narrow", Arial, sans-serif;
            width: auto;
            height: auto;
        }
        .page-break-inside {
            page-break-inside: auto;
        }
        p{
            font-size: 12px;
        }
    </style>
@endpush

@section('content')
    <div class="text-center">
        <h3 class="no-margin"><u>MEDICAL CERTIFICATE OF FITNESS</u></h3>
        <p>No. {{ $record->doc_no }}</p>
    </div>
    <br>
    <table class="data">
        <tr>
            <td colspan="3" class="no-border text-left">Whereof the undersigned below, </td>
        </tr>
        <tr>
            <td colspan="3" class="no-border text-left">&nbsp;</td>
        </tr>
        <tr>
            <td width="25%" class="no-border text-left">Name</td>
            <td width="3%"  class="no-border">:</td>
            <td width="60%" class="no-border">
                @if (isset($record))
                    {{ $record->mail->user->display }}
                @else
                ________________________________________________________
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="3" class="no-border text-left">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" class="no-border text-left">Hereby explain that, </td>
        </tr>
        <tr>
            <td colspan="3" class="no-border text-left">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" class="no-border text-left">
                <table class="data">
                    <tr>
                        @foreach (App\Models\Master\TypeMcu::get() as $item)
                            <td class="text-center" width="3%"><b>{{ $item->id == $record->type_id ? 'X':'' }}</b></td>
                            <td><p>{{ $item->name }}</p></td>
                        @endforeach
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="no-border text-left">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" class="no-border text-left">
                <table class="data">
                    <tr>
                        <td width="25%" class="no-border text-left">Full Name</td>
                        <td width="3%"  class="no-border">:</td>
                        <td width="60%" class="no-border">
                            @if (isset($record))
                                {{ $record->employee->display }}
                            @else
                            ________________________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="25%" class="no-border text-left">Date of Birth/ Age</td>
                        <td width="3%"  class="no-border">:</td>
                        <td width="60%" class="no-border">
                            @if (isset($record))
                                {{ Helpers::DateParse($record->date_birth) }} / {{ $record->ageConvert() }} yo
                            @else
                            ________________________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="25%" class="no-border text-left">Job Position</td>
                        <td width="3%"  class="no-border">:</td>
                        <td width="60%" class="no-border">
                            @if (isset($record))
                                {{ $record->title }}
                            @else
                            ________________________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="25%" class="no-border text-left">Department </td>
                        <td width="3%"  class="no-border">:</td>
                        <td width="60%" class="no-border">
                            @if (isset($record))
                                {{ $record->department }}
                            @else
                            ________________________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="25%" class="no-border text-left">Company </td>
                        <td width="3%"  class="no-border">:</td>
                        <td width="60%" class="no-border">
                            @if (isset($record))
                                {{ $record->company }}
                            @else
                            ________________________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="no-border text-left">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="25%" class="no-border text-left">MCU Provider </td>
                        <td width="3%"  class="no-border">:</td>
                        <td width="60%" class="no-border">
                            @if (isset($record))
                                {{ $record->provider }}
                            @else
                            ________________________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="25%" class="no-border text-left">Date of MCU </td>
                        <td width="3%"  class="no-border">:</td>
                        <td width="60%" class="no-border">
                            @if (isset($record))
                                {{ Helpers::DateParse($record->last_date) }}
                            @else
                            ________________________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="25%" class="no-border text-left">Date of Validation </td>
                        <td width="3%"  class="no-border">:</td>
                        <td width="60%" class="no-border">
                            @if (isset($record))
                                Until {{ Helpers::DateParse($record->due_date) }}
                            @else
                            ________________________________________________________
                            @endif
                        </td>
                    </tr>
                <table>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="no-border text-left">&nbsp;</td>
        </tr>
        @foreach (App\Models\Master\Result::get() as $item)
            <tr>
                <td colspan="3" class="no-border text-left">
                    <input type="checkbox" name="" {{ $item->id == $record->result_id ? 'checked':'' }} id="" style="margin-top: 6px"> {{ $item->name }} 
                </td>
            </tr>
            @if ($item->id == $record->result_id)
                <tr>
                    <td colspan="3" class="no-border text-left">
                        <textarea name="" id="" rows="5">{{ $record->reason_result }}</textarea>
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
    <table class="dont-break-me" style="margin-top: 50px;">
        <tr>
            <td class="no-border text-center text-bold"></td>
            <td class="no-border text-center">{{ $record->site->name }},<br> {{ $today }}</td>
        </tr>
            <tr>
                <td class="no-border" style="height: 80px;"></td>
                <td class="no-border" style="height: 80px;"></td>
            </tr>
            <tr>
                <td class="no-border text-center"></td>
                <td class="no-border text-center text-bold">({{ $record->mail->user->display }})</td>
            </tr>
    </table>
@endsection
