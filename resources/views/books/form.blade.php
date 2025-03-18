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
        <label for="title">Title</label>
        <input type="text"
               class="form-control"
               id="title"
               name="title"
               maxlength="40"
               placeholder="Enter title"
               value="{{isset($books['title']) ? $books['title'] : ''}}"
               required
        >
    </div>
    <div class="form-group">
        <label for="publisher">Publisher</label>
        <input
            type="text"
            class="form-control"
            id="publisher"
            name="publisher"
            maxlength="40"
            placeholder="Enter publisher"
            value="{{ isset($books['publisher']) ? $books['publisher'] : '' }}"
            required
        >
    </div>
    <div class="form-group">
        <label for="edition">Edition</label>
        <input
            type="number"
            class="form-control"
            id="edition"
            name="edition"
            placeholder="Enter edition"
            value="{{ isset($books['edition']) ? $books['edition'] : ''}}"
            min="1"
            max="99999"
            required
        >
    </div>
    <div class="form-group">
        <label for="yearPublication">Year Publication</label>
        <input
            type="text"
            class="form-control"
            id="yearPublication"
            name="yearPublication"
            placeholder="Enter yearPublication"
            maxlength="4"
            value="{{ isset($books['yearPublication']) ? $books['yearPublication'] : ''}}"
            required
        >
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input
            type="number"
            class="form-control"
            id="price"
            name="price"
            placeholder="Enter price"
            step="0.01"
            min="0.01"
            max="99999"
            value="{{isset($books['price']) ? number_format((float)$books['price'], 2, '.', '') : ''}}"
            required
        >
    </div>
    <div class="form-group">
        <label for="authors">Authors</label>
        <select class="form-control" id="authors" name="authors[]" multiple required>
            @forelse($authors as $author)
                @if(isset($books['authors']))
                    <option
                        value="{{ $author['id'] }}" {{ in_array($author['id'], array_column($books['authors'], 'id')) ? 'selected' : ''}} >
                        {{ $author['name'] }}
                    </option>
                @else
                    <option value="{{ $author['id'] }}">
                        {{ $author['name'] }}
                    </option>
                @endif
            @empty
                <option value="">No authors available</option>
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="authors">Subjects</label>
        <select class="form-control" id="subjects" name="subjects[]" multiple required>
            @forelse($subjects as $subject)
                @if(isset($books['subjects']))
                    <option
                        value="{{ $subject['id'] }}" {{ in_array( $subject['id'], array_column($books['subjects'], 'id')) ? 'selected' : ''}} >
                        {{ $subject['description'] }}
                    </option>
                @else
                    <option value="{{ $subject['id'] }}">
                        {{ $subject['description'] }}
                    </option>
                @endif
            @empty
                <option value="">No subjects available</option>
            @endforelse
        </select>
    </div>
</div>
