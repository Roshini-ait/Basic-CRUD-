<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editStudentForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-phonenumber" class="form-label">Phone</label>
                        <input type="tel" name="phonenumber" id="edit-phonenumber" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-address" class="form-label">Address</label>
                        <textarea name="address" id="edit-address" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-zipcode" class="form-label">Zipcode</label>
                        <input type="text" name="zipcode" id="edit-zipcode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div>
                            <label><input type="radio" name="gender" value="male" id="edit-gender-male" required> Male</label>
                            <label><input type="radio" name="gender" value="female" id="edit-gender-female" required> Female</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-dob" class="form-label">Date of Birth</label>
                        <input type="date" name="dob" id="edit-dob" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
