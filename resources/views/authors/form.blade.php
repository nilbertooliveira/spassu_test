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
        <label for="name">Name</label>
        <input type="text"
               class="form-control"
               id="name"
               name="name"
               maxlength="40"
               value="{{isset($author['name']) ? $author['name'] : '' }}"
               placeholder="Enter name"
               required
        >
    </div>
</div>
