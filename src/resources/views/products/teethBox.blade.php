@php
/** @var string $fieldName */
@endphp

<div class="col-md-6" style="padding: 0px;">
    <div class="col-md-12" style="padding: 0px;">
        @foreach (range(18, 11) as $i)
        <div class="col-md-1" style="padding: 0px;">
            <center>
                <label>
                    <img src="{{ asset("images/$i.jpg") }}" class="img-responsive"/><br/>{{ $i }}<br/>
                    <input type="checkbox"
                           name="data[{{ $fieldName }}][{{ $i }}]" {{ isset(old('data')[$fieldName][$i]) ? 'checked' : '' }}>
                </label>
            </center>
        </div>
        @endforeach

        @foreach (range(21, 24) as $i)
            <div class="col-md-1" style="padding: 0px;">
                <center>
                    <label>
                        <img src="{{ asset("images/$i.jpg") }}" class="img-responsive"/><br/>{{ $i }}<br/>
                        <input type="checkbox"
                               name="data[{{ $fieldName }}][{{ $i }}]" {{ isset(old('data')[$fieldName][$i]) ? 'checked' : '' }}>
                    </label>
                </center>
            </div>
        @endforeach
    </div>
</div>
<div class="col-md-6" style="padding: 0px;">
    <div class="col-md-12" style="padding: 0px;">
        @foreach (range(25, 28) as $i)
            <div class="col-md-1" style="padding: 0px;">
                <center>
                    <label>
                        <img src="{{ asset("images/$i.jpg") }}" class="img-responsive"/><br/>{{ $i }}<br/>
                        <input type="checkbox"
                               name="data[{{ $fieldName }}][{{ $i }}]" {{ isset(old('data')[$fieldName][$i]) ? 'checked' : '' }}>
                    </label>
                </center>
            </div>
        @endforeach
    </div>
</div>

<div class="col-md-12">&nbsp;</div>

<div class="col-md-6" style="padding: 0px;">
    <div class="col-md-12" style="padding: 0px;">
        @foreach (range(48, 41) as $i)
            <div class="col-md-1" style="padding: 0px;">
                <center>
                    <label>
                        <img src="{{ asset("images/$i.jpg") }}" class="img-responsive"/><br/>{{ $i }}<br/>
                        <input type="checkbox"
                               name="data[{{ $fieldName }}][{{ $i }}]" {{ isset(old('data')[$fieldName][$i]) ? 'checked' : '' }}>
                    </label>
                </center>
            </div>
        @endforeach

        @foreach (range(31, 34) as $i)
            <div class="col-md-1" style="padding: 0px;">
                <center>
                    <label>
                        <img src="{{ asset("images/$i.jpg") }}" class="img-responsive"/><br/>{{ $i }}<br/>
                        <input type="checkbox"
                               name="data[{{ $fieldName }}][{{ $i }}]" {{ isset(old('data')[$fieldName][$i]) ? 'checked' : '' }}>
                    </label>
                </center>
            </div>
        @endforeach

    </div>
</div>

<div class="col-md-6" style="padding: 0px;">
    <div class="col-md-12" style="padding: 0px;">
        @foreach (range(35, 38) as $i)
            <div class="col-md-1" style="padding: 0px;">
                <center>
                    <label>
                        <img src="{{ asset("images/$i.jpg") }}" class="img-responsive"/><br/>{{ $i }}<br/>
                        <input type="checkbox"
                               name="data[{{ $fieldName }}][{{ $i }}]" {{ isset(old('data')[$fieldName][$i]) ? 'checked' : '' }}>
                    </label>
                </center>
            </div>
        @endforeach
    </div>
</div>