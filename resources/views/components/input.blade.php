<div class="form-group row">
    <label class="col-12 col-sm-3 col-form-label text-sm-right">{{ $label }}</label>
    <div class="col-12 col-sm-8 col-lg-6">
        <input type="{{ $type }}" {{ $require }} name="{{ $name }}" value="{{ $value }}" id="{{ $id }}"    placeholder="{{ $ph }}" class="form-control">
       @error( $name )
            <span style="color: red">{{ $message }}</span>
        @enderror 
    </div>
</div>