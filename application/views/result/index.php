<?php $this->load->view('layout/header'); ?>

<section class="content py-4">
    <div class="container-fluid">

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Result List</h4>

                <a href="<?php echo site_url('result/create') ?>" class="btn btn-primary rounded-pill">
                    Add Result
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Exam</th>
                                <th>Marks</th>
                                <th>Grade</th>
                                <th>GPA</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($results as $key => $row): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $row->student_name ?></td>
                                <td><?= $row->class_name ?></td>
                                <td><?= $row->subject_name ?></td>
                                <td><?= $row->exam_name ?></td>
                                <td><?= $row->marks ?></td>
                                <td><?= $row->grade ?></td>
                                <td><?= $row->gpa ?></td>
                                <td>
                                    <a href="<?= base_url('result/edit/'.$row->id) ?>" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <a href="<?= base_url('result/delete/'.$row->id) ?>"
                                       onclick="return confirm('Are you sure?')"
                                       class="btn btn-sm btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

<?php $this->load->view('layout/footer'); ?>