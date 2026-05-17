<?php $this->load->view('layout/header'); ?>

<section class="content py-4">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Class Management</h3>
                <p class="text-muted mb-0 small">
                    ERP / Academic / Class List
                </p>
            </div>
            <a href="<?php echo site_url('classes/create'); ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Add Class
            </a>
        </div>

        <div class="card erp-card">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Class List</h6>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>SL</th>
                       
                            <th>Claass Name</th>
                            <th>Numeric</th>
                            
                    
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($classes as $index => $class) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                
                                
                                <td><?php echo $class->class_name ?></td>
                                <td>
                                    <?php echo $class->class_numeric; ?>
                                </td>
                              
                              
                                <td>

                                    <a href="<?php echo site_url("classes/edit/{$class->id}"); ?>" class="btn btn-sm btn-primary">
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
