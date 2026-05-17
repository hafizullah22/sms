<?php $this->load->view('layout/header'); ?>

<section class="content py-4">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Subject Management</h3>
                <p class="text-muted mb-0 small">
                    ERP / Academic / Subject List
                </p>
            </div>
            <a href="<?php echo site_url('teachers/create'); ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Add Teacher
            </a>
        </div>

        <div class="card erp-card">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Teacher List</h6>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Teacher Name</th>
                            <th>Designation</th>
                            <th>Salary</th>
                            <th>Joining Date</th>
                    
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($teachers as $index => $teacher) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                
                                <td><img src="<?php echo base_url($teacher->image); ?>"alt="Teacher Image" 
                                    width="60" height="60"></td>
                                <td><?php echo $teacher->teacher_name; ?></td>
                                <td>
                                    <?php echo $teacher->designation; ?>
                                </td>
                                <td>    <?php echo $teacher->salary; ?> </td>
                           
                                <td> <?php echo $teacher->joining_date; ?> </td>
                              
                                <td>

                                    <a href="<?php echo site_url("teachers/edit/{$teacher->id}"); ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('layout/footer'); ?>
