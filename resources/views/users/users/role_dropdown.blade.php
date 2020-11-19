<select name="role_id" id="role_id" class="form-control select2-single" data-width="100%">
@foreach($roles as $key =>$role)
<option value="{{$role->id}}">{{$role->title}}</option>
@endforeach
</select>