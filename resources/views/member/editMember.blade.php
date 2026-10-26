@extends("layout.master")
@section("content")



<body>
    <main class="container">

        <header class="header">
            <h1>Update Person</h1>
        </header>

        <section class="form-card">

            @if (session('success'))
            <div class="alert-success" role="status">
                {{ session('success') }}
            </div>
            @endif

            <form action="/member/{{ $members->id }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method("put")
                <div class="form-grid">

                    <!-- First Name -->
                    <div class="form-group">
                        <label for="name">
                            First Name <span class="required">*</span>
                        </label>

                        <input type="text" id="name" name="name" value="{{ $members->name}}"
                            placeholder="Enter first name" maxlength="50" autocomplete="given-name"
                            class="@error('name') is-invalid @enderror" required
                            aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}">

                        @error('name')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="lastname">
                            Last Name <span class="required">*</span>
                        </label>

                        <input type="text" id="lastname" name="last_name" value="{{ $members->last_name }}"
                            placeholder="Enter last name" maxlength="50" autocomplete="family-name"
                            class="@error('lastname') is-invalid @enderror" required
                            aria-invalid="{{ $errors->has('lastname') ? 'true' : 'false' }}">

                        @error('lastname')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="form-group ">
                        <label for="phone">
                            Phone Number <span class="required">*</span>
                        </label>

                        <input type="tel" id="phone" name="phone" value="{{ $members->phone }}"
                            placeholder="e.g. 0701234567" maxlength="20" autocomplete="tel" inputmode="tel"
                            class="@error('phone') is-invalid @enderror" required
                            aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}">

                        @error('phone')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="form-group ">
                        <label for="image">
                            Profile Image <span class="required">*</span>
                        </label>

                        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp"
                            class="@error('image') is-invalid @enderror"
                            aria-invalid="{{ $errors->has('image') ? 'true' : 'false' }}" value="{{ $members->image }}">

                        <small class="hint">
                            Allowed formats: JPG, JPEG, PNG, WEBP.
                            Maximum size: 2 MB.
                        </small>

                        <img id="imagePreview" class="preview" alt="Selected profile image preview">

                        @error('image')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Dropdown -->
                    <div class="form-group full-width">
                        <label for="status">
                            Status <span class="required">*</span>
                        </label>

                        <select id="status" name="status" class="@error('status') is-invalid @enderror" required
                            aria-invalid="{{ $errors->has('status') ? 'true' : 'false' }}">
                            <option value="{{ $members->status }}">Select status</option>

                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>

                        @error('status')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="form-actions">
                    <button type="submit" class="submit-btn">
                        Save Person
                    </button>

                    <button type="reset" class="reset-btn" id="resetBtn">
                        Reset Form
                    </button>
                </div>

            </form>
        </section>
    </main>

    <script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const resetBtn = document.getElementById('resetBtn');

    let previewUrl = null;

    imageInput.addEventListener('change', function() {
        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        const file = this.files[0];

        if (!file) {
            imagePreview.removeAttribute('src');
            imagePreview.style.display = 'none';
            return;
        }

        if (!file.type.startsWith('image/')) {
            this.value = '';
            imagePreview.style.display = 'none';
            alert('Please select an image file.');
            return;
        }

        previewUrl = URL.createObjectURL(file);
        imagePreview.src = previewUrl;
        imagePreview.style.display = 'block';
    });

    resetBtn.addEventListener('click', function() {
        imageInput.value = '';
        imagePreview.removeAttribute('src');
        imagePreview.style.display = 'none';

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }
    });
    </script>
    @endsection