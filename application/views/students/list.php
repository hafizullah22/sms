<?php $this->load->view('layout/header'); ?>

<style>
  
    .card { border: none; border-radius: 8px; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
    .card-header { background-color: #fff; border-bottom: 1px solid #edf2f9; padding: 1.25rem; }
    .table thead th { 
        background-color: #f8f9fa; 
        text-transform: uppercase; 
        font-size: 0.75rem; 
        letter-spacing: 0.05em; 
        color: #0e0e0f;
        border-top: none;
    }
    .badge-soft-success { background-color: #d1f2e1; color: #0f6848; }
</style>


    <div class="container-fluid px-4">
        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold mb-0">Student Directory</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Academic</a></li>
                        <li class="breadcrumb-item active">Student List</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-download me-1"></i> Export</button>
               
                <a href="<?php echo site_url('student/create')?>" class="btn btn-primary btn-sm"><i class="bi bi-plus me-1"></i>Add New Student</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" class="form-control bg-light border-start-0" placeholder="Search students...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Full Name</th>
                                    <th>Roll No</th>
                                    <th>Reg. Number</th>
                                    <th>Class</th>
                                    <th>Year</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($students)): ?>
                                    <?php foreach($students as $student): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                        <img src="<?php echo base_url('assets/images/avatars/default.jpg'); ?>" style="width:100%; border-radius:50%">
                                                    </div>
                                                    <span class="fw-semibold text-dark"><?php echo $student->full_name; ?></span>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light text-dark border"><?php echo $student->roll_no; ?></span></td>
                                            <td><code><?php echo $student->registration_no; ?></code></td>
                                            <td>Class <?php echo $student->class_id; ?></td>
                                            <td><span class="badge badge-soft-success"><?php echo $student->year; ?></span></td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-primary btn-sm viewStudentBtn" data-id="<?php echo $student->id; ?>"> 
                                                    <i class="bi bi-eye"></i> View
                                                </button>
                                                <a href="<?php echo site_url('student/edit/'.$student->id); ?>" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">No students found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer bg-white border-top-0 py-3">
                        <p class="text-muted small mb-0">Showing <?php echo count($students); ?> entries</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="studentViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="studentViewModalLabel">
                    <i class="bi bi-person-badge me-2"></i>Student Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="studentViewData">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2 text-muted">Loading student information...</p>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener("DOMContentLoaded", function() {
    // Check if jQuery is available
    if (typeof jQuery === "undefined") {
        console.error("Bootstrap Modal requires jQuery. Make sure it is loaded in your header or footer.");
        return;
    }

    $(document).on('click', '.viewStudentBtn', function(e){
        e.preventDefault();
        let student_id = $(this).data('id');
        
        // Initialize Modal
        let modalElement = document.getElementById('studentViewModal');
        let myModal = new bootstrap.Modal(modalElement);
        myModal.show();

        // Reset the body content to loader
        $('#studentViewData').html(`
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2 text-muted">Fetching record...</p>
            </div>
        `);

        // AJAX call
        $.ajax({
            url: "<?php echo site_url('student/view/'); ?>" + student_id,
            type: "GET",
            success: function(response){
                $('#studentViewData').html(response);
            },
            error: function(){
                $('#studentViewData').html(`
                    <div class="alert alert-danger m-3">
                        Failed to load data. Please check your internet or permissions.
                    </div>
                `);
            }
        });
    });
});
</script>

<?php $this->load->view('layout/footer'); ?>