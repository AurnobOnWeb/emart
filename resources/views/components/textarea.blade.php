<div class="form-group row">
    <label class="col-12 col-sm-3 col-form-label text-sm-right">{{ $label }}</label>
    <div class="col-12 col-sm-8 col-lg-6">
        <textarea {{ $require }} name="{{ $name }}" class="form-control" placeholder="{{ $ph }}">{{ $val }}</textarea>
    </div>
</div>