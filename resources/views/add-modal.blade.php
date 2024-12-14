<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phonenumber" class="form-label">Phone</label>
                        <input type="tel" name="phonenumber" class="form-control" value="{{ old('phonenumber') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <select name="city" class="form-control" required>
                            <option value="City1">City1</option>
                            <option value="City2">City2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <select name="state" class="form-control" required>
                            <option value="State1">State1</option>
                            <option value="State2">State2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select name="country" class="form-control" required>
                            <option value="Country1">Country1</option>
                            <option value="Country2">Country2</option>
                        </select>
                    </div> -->
                    <div class="mb-3">
                        <label for="zipcode" class="form-label">Zipcode</label>
                        <input type="text" name="zipcode" class="form-control" value="{{ old('zipcode') }}" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="number" name="role" class="form-control" value="{{ old('role') }}" required>
                    </div> -->
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div>
                            <label><input type="radio" name="gender" value="male" required> Male</label>
                            <label><input type="radio" name="gender" value="female" required> Female</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
