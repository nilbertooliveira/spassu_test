<div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text"
               class="form-control"
               id="description"
               name="description"
               maxlength="20"
               value="{{isset($subject['description']) ? $subject['description'] : '' }}"
               placeholder="Enter description"
               required
        >
    </div>
</div>
