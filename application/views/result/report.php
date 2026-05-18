<?php $this->load->view('layout/header'); ?>
<head>
    <title>Class Performance Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container-fluid py-0">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-dark fw-bold">Class-wise Result Report</h5>
      
            <div class="d-flex gap-2 d-print-none">
                <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                    Print View
                </button>
                <a href="#" id="pdf_download_btn" class="btn btn-danger btn-sm" style="display:none;" target="_blank">
                    Download PDF Report
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row mb-4 d-print-none">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Select Class</label>
                    <select id="report_class_id" class="form-select border-primary">
                        <option value="">-- Choose Class --</option>
                        <?php foreach($classes as $c): ?>
                            <option value="<?= $c->id ?>"><?= $c->class_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Select Year</label>
                    <select id="report_year" class="form-select border-primary">
                        <option value="">-- Choose Year --</option>
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
            </div>

            <div id="report_container" class="table-responsive" style="display:none;">
                <table class="table table-bordered table-striped align-middle">
                    <thead id="report_header" class="table-dark text-center"></thead>
                    <tbody id="report_body"></tbody>
                </table>
            </div>

            <div id="no_data" class="text-center py-5 text-muted">
                <p>Select both a class and a year to generate the performance report.</p>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    
    // Function to handle generating reports and tracking PDF downloads
    function generateReport() {
        let classId = $('#report_class_id').val();
        let year = $('#report_year').val();

        // Clear view area if parameters are missing
        if (!classId || !year) {
            $('#report_container').hide();
            $('#pdf_download_btn').hide();
            $('#no_data').show();
            return;
        }

        // Fetch data based on Class AND Year
        $.post("<?= site_url('result/get_report_data') ?>", {class_id: classId, year: year}, function(res) {
            let data = JSON.parse(res);
            
            // Check if there are students registered in that specific year/class
            if (!data.students || data.students.length === 0) {
                $('#report_container').hide();
                $('#pdf_download_btn').hide();
                $('#no_data').html('<p class="text-danger fw-bold">No data found for the selected Class and Year combination.</p>').show();
                return;
            }

            // 1. Build Header Dynamically
            let headerHtml = '<tr><th>Roll</th><th>Student Name</th>';
            data.subjects.forEach(sub => {
                headerHtml += `<th>${sub.subject_name}</th>`;
            });
            headerHtml += '<th class="bg-primary text-white">Total</th></tr>';
            $('#report_header').html(headerHtml);

            // 2. Build Student rows
            let bodyHtml = '';
            data.students.forEach(st => {
                let total = 0;
                bodyHtml += `<tr>
                    <td class="text-center">${st.roll_no}</td>
                    <td class="fw-bold">${st.full_name}</td>`;
                
                data.subjects.forEach(sub => {
                    let score = (data.marks[st.id] && data.marks[st.id][sub.id]) ? parseFloat(data.marks[st.id][sub.id]) : 0;
                    total += score;
                    
                    let textClass = (score < 33) ? 'text-danger fw-bold' : '';
                    bodyHtml += `<td class="text-center ${textClass}">${score > 0 ? score : '-'}</td>`;
                });

                bodyHtml += `<td class="text-center fw-bold bg-light">${total}</td></tr>`;
            });

            $('#report_body').html(bodyHtml);
            $('#no_data').hide();
            
            // Generate customized programmatic link route for PDF conversion engines
            let pdfUrl = "<?= site_url('result/generate_pdf/') ?>" + classId + "/" + year;
            $('#pdf_download_btn').attr('href', pdfUrl).fadeIn();
            
            $('#report_container').fadeIn();
        });
    }

    // Bind event changes to both inputs cleanly
    $('#report_class_id, #report_year').change(function() {
        generateReport();
    });
});
</script>
</body>