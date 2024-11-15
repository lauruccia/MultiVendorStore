<div class="form-group">
    <x-form.input name="name" :value="$category->name" type="text" label="Category Name"/> 
</div>
<div class="form-group">
    <label for="">Category Parent</label>
    <select name="parent_id" class="form-control">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <x-form.textarea name="description" :value="$category->description" label="Description"/>
</div>
<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <x-form.input name="image" type="file" accept="image/*"/>
    @if ($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50">
        <button type="button" class="btn btn-danger" onclick="deleteImage()">Delete</button>
    @endif
</div>
<div class="form-group">
    <label for="">Status</label>
    <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']"/>
    @error('status')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_text ?? 'save' }}</button>
</div>
