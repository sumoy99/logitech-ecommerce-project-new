<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('superadmin.about.testimonial_store') }}">
        @csrf 
        <div class="form-row">
			<div class="fpb-7">
                <label for="name" class="eForm-label">{{ get_phrase('Client Name') }}</label>
                <input type="text" class="form-control eForm-control" id="name" name = "name" placeholder="Provide Client name" maxlength="50" required>
            </div>
			<div class="fpb-7">
                <label for="designation" class="eForm-label">{{ get_phrase('Designation') }}</label>
                <input type="text" class="form-control eForm-control" id="designation" name = "designation" placeholder="Provide designation" maxlength="50" required>
            </div>
			<div class="fpb-7">
                <label for="description" class="eForm-label">{{ get_phrase('Description') }}</label>
                <textarea type="text" class="form-control eForm-control" id="description" name = "description" placeholder="Write here..." maxlength="200" required></textarea>
            </div>

            <div class="fpb-7">
                <label for="image" class="eForm-label">{{ get_phrase('Client Image') }}</label>
                <input type="file" class="form-control eForm-control" id="image" name = "image" required>
            </div>

            <div class="fpb-7 pt-2">
                <button class="btn-form" type="submit">{{ get_phrase('Create testimonial') }}</button>
            </div>
		</div>
	</form>
</div>
