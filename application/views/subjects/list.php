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
            <a href="<?php echo site_url('subject/create'); ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Add Subject
            </a>
        </div>

        <div class="card erp-card">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Subject List</h6>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject Name</th>
                            <th>Class</th>
                            <th>Year</th>
                            <th>Type</th>
                            <th>Total Marks</th>
                            <th>Pass Marks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($subjects as $index => $subject) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $subject->subject_name; ?></td>
                                <td>
                                    <?php
                                    $class = $this->db->get_where('classes', ['id' => $subject->class_id])->row();
                                    echo $class ? $class->class_name : 'N/A';
                                    ?>
                                </td>
                                <td><?php echo $subject->year; ?></td>
                                <td>
                                    <?php
                                    if ($subject->subject_type == 1) {
                                        echo '<span class="badge bg-success">Compulsory</span>';
                                    } elseif ($subject->subject_type == 2) {
                                        echo '<span class="badge bg-info">Optional</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary">Unknown</span>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $subject->total_marks; ?></td>
                                <td><?php echo $subject->pass_marks; ?></td>
                                <td>

                                    <a href="<?php echo site_url("subject/edit/{$subject->id}"); ?>" class="btn btn-sm btn-primary">
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
