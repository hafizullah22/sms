<?php $this->load->view('layout/header'); ?>

<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-dark fw-bold">Class-wise Reports Control Panel</h5>
        </div>
        
        <div class="card-body">
            <form id="reportForm" action="<?= site_url('reports/report') ?>" method="POST" target="_blank">
                
                <div class="row g-3 mb-4 d-print-none align-items-end">
                    
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-secondary">1. Select Class</label>
                        <select id="report_class_id" name="class_id" class="form-select border-primary">
                            <option value="">-- Choose Class --</option>
                            <?php foreach($classes as $c): ?>
                                <option value="<?= $c->id ?>"><?= $c->class_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold text-secondary">2. Select Year</label>
                        <select id="report_year" name="year" class="form-select border-primary">
                            <option value="">-- Choose Year --</option>
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-bold text-secondary">3. Select Report Type</label>
                        <select id="report_type" name="report_type" class="form-select border-primary">
                            <option value="">-- Choose Report --</option>
                            <option value="101">Admit Card</option>
                            <option value="102">Attendance Sheet</option>
                            <option value="103">Seat Sticker</option>
                        </select>
                    </div>

                    <div class="col-md-3 d-grid">
                        <button type="submit" id="submit_report_btn" class="btn btn-primary fw-bold shadow-sm">
                            <i class="fas fa-file-alt me-1"></i> Generate Report
                        </button>
                    </div>

                </div>
            </form>

            <hr class="text-muted opacity-25">

            <div id="no_data" class="text-center py-5 text-muted">
                <div class="mb-3">
                    <i class="fas fa-sliders-h fa-2x text-primary opacity-50"></i>
                </div>
                <p class="mb-0">Please select a Class, Year, and Report Type above, then click <strong>Generate Report</strong>.</p>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    
    $('#reportForm').on('submit', function(e) {
        let classId    = $('#report_class_id').val();
        let year       = $('#report_year').val();
        let reportType = $('#report_type').val();
        
        // Validation Guard: Prevents form execution if fields are blank
        if (!classId || !year || !reportType) {
            e.preventDefault(); // Stop the form submission
            
            Swal.fire({
                icon: 'warning',
                title: 'Selection Incomplete',
                text: 'Please populate all selection filters before request compilation.',
                confirmButtonColor: '#0d6efd',
                customClass: { popup: 'rounded-4' }
            });
            return false;
        }
        
        // Simple UI feedback reminder to help user keep track of system generation states
        let btn = $('#submit_report_btn');
        let originalContent = btn.html();
        
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Generating...');
        
        // Restore standard button layout state shortly after processing the submission
        setTimeout(function() {
            btn.prop('disabled', false).html(originalContent);
        }, 1500);
    });
});
</script>

<?php $this->load->view('layout/footer'); ?>