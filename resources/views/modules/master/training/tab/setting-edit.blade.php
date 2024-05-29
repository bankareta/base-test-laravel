<table class="ui celled table">
    <tbody>
        <tr>
            <td colspan="2"><b>Time Limit</b>  <br><small class="font red"><i>(checked here if this training have a time limit)</i></small></td>
            <td colspan="2"><b>Percentage Minimum Score</b>  <br>  <small class="font red"><i>(checked here if this training have minimum score)</i></small></td>
            <td colspan="2"><b>Retake training</b>  <br>  <small class="font red"><i>(checked here if this training can be retake when user doesnt pass the minimum score)</i></small></td>
        </tr>
        <tr>
            <td class="center aligned middle aligned one wide">
                <div class="field">
                    <div class="ui checkbox {{ $record->time_limit == 1 ? 'checked' : '' }}">
                        <input type="checkbox" name="time_limit" value="1" {{ $record->time_limit == 1 ? 'checked' : '' }}>
                        <label>&nbsp;</label>
                    </div>
                </div>
            </td>
            <td class="two wide">
                <div class="field">
                    <div class="ui labeled input timelimit disabled">
                        <input type="number" step="1" placeholder="minutes" class="timelimit" name="time_limit_minutes" value="{{ $record->time_limit_minutes or '' }}">
                        <div class="ui label">
                            Minutes
                        </div>
                    </div>
                </div>
            </td>
            <td class="center aligned middle aligned one wide">
                <div class="field">
                    <div class="ui checkbox {{ $record->min_score == 1 ? 'checked' : '' }}">
                        <input type="checkbox" name="min_score" value="1" {{ $record->min_score == 1 ? 'checked' : '' }}>
                        <label>&nbsp;</label>
                    </div>
                </div>
            </td>
            <td class="two wide">
                <div class="field">
                    <div class="ui labeled input minscore disabled">
                        <input type="number" name="min_score_percentage" value="{{ $record->min_score_percentage or '' }}">
                        <div class="ui label">
                            %
                        </div>
                    </div>
                </div>
            </td>
            <td class="left aligned middle aligned four wide">
                <div class="grouped fields">
                    <div class="field">
                        <div class="ui checkbox minscore disabled {{ $record->retake == 1 ? 'checked' : '' }}">
                            <input type="checkbox" name="retake" class="minscore" value="1" disabled {{ $record->retake == 1 ? 'checked' : '' }}>
                            <label>immediately</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui checkbox minscore disabled {{ $record->retake == 2 ? 'checked' : '' }}">
                            <input type="checkbox" name="retake" class="minscore" value="2" disabled  {{ $record->retake == 2 ? 'checked' : '' }}>
                            <label>days</label>
                        </div>
                    </div>
                </div>
            </td>
            <td class="two wide">
                <div class="field">
                    <div class="ui labeled input retake disabled">
                        <input type="number" name="retake_days" value="{{ $record->retake_days or '' }}">
                        <div class="ui label">
                            day
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>Effective Date</b>  <br>  <small class="font red"><i>(Effective date training will start)</i></small></td>
            <td colspan="2"><b>Expired Date</b>  <br>  <small class="font red"><i>(Expired date, training cant be take after expired date)</i></small></td>
            <td colspan="2"><b>Repeat training</b>  <br><small class="font red"><i>(checked here if you want training to be repeat when training expired)</i></small></td>
        </tr>
        <tr>
            <td class="two wide" colspan="2">
                <div class="field">
                    <div class="field chooseDate">
                        <input type="text" name="effective_date" placeholder="Effective Date" value="{{ $record->effective_date or '' }}">
                    </div>
                </div>
            </td>
            <td class="center aligned middle aligned one wide">
                <div class="field">
                    <div class="ui checkbox" {{ $record->expired == 1 ? 'checked' : '' }}>
                        <input type="checkbox" name="expired" value="1"  {{ $record->expired == 1 ? 'checked' : '' }}>
                        <label>&nbsp;</label>
                    </div>
                </div>
            </td>
            <td class="two wide">
                <div class="field">
                    <div class="field chooseDate">
                        <input type="text" name="expired_date" placeholder="Expired Date" disabled  value="{{ $record->expired_date or '' }}">
                    </div>
                </div>
            </td>
            <td class="center aligned middle aligned one wide">
                <div class="field">
                    <div class="ui checkbox {{ $record->repeat == 1 ? 'checked' : '' }}">
                        <input type="checkbox" name="repeat" value="1" {{ $record->repeat == 1 ? 'checked' : '' }}>
                        <label>&nbsp;</label>
                    </div>
                </div>
            </td>
            <td class="two wide">
                <div class="field">
                    <div class="ui labeled input repeatmonths disabled">
                        <input type="number" step="1" name="repeat_months" class="repeatmonths" disabled value="{{ $record->repeat_months or '' }}">
                        <div class="ui label">
                            Months
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="center aligned middle aligned four wide">
                <div class="field">
                    <div class="ui checkbox {{ $record->sent_email == 1 ? 'checked' : '' }}">
                        <input type="checkbox" name="sent_email" value="1" {{ $record->sent_email == 1 ? 'checked' : '' }}>
                        <label>&nbsp;</label>
                    </div>
                </div>
            </td>
            <td colspan="3" class="sendemail disabled"><b>Sent Email Alert</b>  <br>  <small class="font red"><i>(Sent alert email to each participant)</i></small></td>
            <td colspan="2">
                                        <div class="grouped fields">
                                            <label>Required ? <br>  <small class="font red"><i>(Checked the field's)</i></small></label>

                                            <div class="field">
                                                <div class="ui radio">
                                                    <input type="radio" name="mandatory" value="1" {{ ($record->mandatory == 1) ? 'checked' : '' }}>
                                                    <label>Mandatory</label>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui radio">
                                                    <input type="radio" name="mandatory" value="2" {{ ($record->mandatory == 2) ? 'checked' : '' }}>
                                                    <label>Not Mandatory</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
        </tr>
        <tr>
        </tr>
    </tbody>
</table>

<div class="fields">

</div>
<div class="ui two column grid">
    <div class="left aligned column">
        <div class="ui labeled icon button next" data-prev="three" data-tab="second">
          <i class="chevron left icon"></i>
          Back
        </div>
    </div>
    <div class="right aligned column">
      <div class="ui right labeled icon button next" data-prev="three" data-tab="four">
        Next
        <i class="chevron right icon"></i>
      </div>
    </div>
  </div>