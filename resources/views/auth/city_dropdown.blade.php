@foreach($cities as $key =>$value)
<option value="{{$value->id}}" @if (old('district') == "$value->id") {{ 'selected' }} @endif>{{$value->city_name}}</option>
@endforeach
