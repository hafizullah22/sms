<?php $this->load->view('layout/header'); ?>
<head>
    <title>Result Entry System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .mark-input:focus { background-color: #fffde7; border-color: #ffc107; }
        .table-v-align td { vertical-align: middle; }
    </style>
</head>
<body class="bg-light">

<div class="container py-0">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary">Academic Result Entry</h5>
        </div>
        <div class="card-body">
            
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-bold">1. Select Class</label>
                    <select id="class_selector" class="form-select border-primary">
                        <option value="">-- Choose Class --</option>
                        <?php foreach($classes as $c): ?>
                            <option value="<?= $c->id ?>"><?= $c->class_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">2. Select Year</label>
                    <select id="year_selector" class="form-select">
                        <option value="">-- Select Year --</option>
                        <option value="2026">2026</option> 
                        <option value="2025">2025</option> 
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label fw-bold">3. Select Subject</label>
                    <select id="subject_selector" class="form-select" disabled>
                        <option value="">-- Select Class & Year First --</option>
                    </select>
                </div>
            </div>

            <div id="entry_area" style="display:none;">
                <hr>
                <form id="batchSaveForm">
                    <input type="hidden" name="class_id" id="hidden_class_id">
                    <input type="hidden" name="subject_id" id="hidden_subject_id">
                    <input type="hidden" name="year" id="hidden_year">

                    <div class="table-responsive">
                        <table class="table table-hover table-v-align">
                            <thead class="table-dark">
                                <tr>
                                    <th width="100">Roll No</th>
                                    <th>Student Name</th>
                                    <th width="200">Marks Obtained</th>
                                </tr>
                            </thead>
                            <tbody id="student_list"></tbody>
                        </table>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" id="save_btn" class="btn btn-primary btn-lg px-5 shadow">
                            Save All Marks
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // Fetch Students & Subjects only when BOTH Class and Year are selected
    $('#class_selector, #year_selector').change(function() {
        let classId = $('#class_selector').val();
        let year = $('#year_selector').val();

        // Reset if either is missing
        if (!classId || !year) {
            $('#subject_selector').html('<option value="">-- Select Class & Year First --</option>').prop('disabled', true);
            $('#entry_area').hide();
            return;
        }

        // Fetch students and subjects assigned specifically to this Class and Year
        $.post("<?= site_url('result/get_data') ?>", {class_id: classId, year: year}, function(res) {
            let data = JSON.parse(res);
            
            $('#hidden_class_id').val(classId);
            $('#hidden_year').val(year);
            
            // Populate Subjects
            let subHtml = '<option value="">-- Choose Subject --</option>';
            data.subjects.forEach(s => subHtml += `<option value="${s.id}">${s.subject_name}</option>`);
            $('#subject_selector').html(subHtml).prop('disabled', false);

            // Populate Students 
            let stHtml = '';
            if(data.students.length > 0) {
                data.students.forEach(st => {
                    stHtml += `
                    <tr>
                        <td><span class="badge bg-secondary">${st.roll_no}</span></td>
                        <td class="fw-bold">${st.full_name}</td>
                        <td>
                            <input type="hidden" name="student_id[]" value="${st.id}">
                            <input type="number" name="marks[]" id="mark_input_${st.id}" 
                                   class="form-control mark-input" min="0" max="100" required>
                        </td>
                    </tr>`;
                });
            } else {
                stHtml = '<tr><td colspan="3" class="text-center text-danger">No students found registered for this class in '+year+'</td></tr>';
            }
            $('#student_list').html(stHtml);
            
            // If they change class/year after subject was already active, reset evaluation
            $('#subject_selector').val('');
            $('#entry_area').hide();
        });
    });

    // Load Existing Marks once Subject is picked
    $('#subject_selector').change(function() {
        let subjectId = $(this).val();
        let classId = $('#hidden_class_id').val();
        let year = $('#hidden_year').val();
        
        $('#hidden_subject_id').val(subjectId);
        $('.mark-input').val(''); // Clear old inputs

        if (subjectId && classId && year) {
            $.post("<?= site_url('result/get_existing_marks') ?>", {class_id: classId, subject_id: subjectId, year: year}, function(res) {
                try {
                    let marks = JSON.parse(res);
                    Object.keys(marks).forEach(studentId => {
                        $(`#mark_input_${studentId}`).val(marks[studentId]);
                    });
                } catch(e) { console.log("Fresh entry setup."); }
                
                // Show entry screen even if zero marks exist inside DB
                $('#entry_area').fadeIn();
            });
        } else {
            $('#entry_area').hide();
        }
    });

  // Form Submission (Batch Save) - Direct Action
    $('#batchSaveForm').on('submit', function(e) {
        e.preventDefault();
        
        let form = $(this);
        let btn = $('#save_btn');

        // 1. Immediate Professional Loading State
        Swal.fire({
            title: 'Saving Marks',
            text: 'Please wait while records are being updated...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            },
            customClass: { 
                popup: 'rounded-4 shadow-sm' 
            }
        });

        btn.prop('disabled', true).text('Saving Data...');

        // 2. AJAX Request
        $.ajax({
            url: "<?= site_url('result/store_batch') ?>",
            type: "POST",
            data: form.serialize(),
            success: function(res) {
                try {
                    let response = JSON.parse(res);
                    if(response.status === 'success') {
                        // Clean Auto-closing Success Toast/Alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: { popup: 'rounded-4' }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Execution Failed',
                            text: response.message,
                            confirmButtonColor: '#0d6efd',
                            customClass: { popup: 'rounded-4' }
                        });
                    }
                } catch(e) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Parser Error',
                        text: 'Invalid Response Format.',
                        confirmButtonColor: '#0d6efd',
                        customClass: { popup: 'rounded-4' }
                    });
                }
            },
            error: function() { 
                Swal.fire({
                    icon: 'error',
                    title: 'Network Error',
                    text: 'Server connection failed. Please try again.',
                    confirmButtonColor: '#0d6efd',
                    customClass: { popup: 'rounded-4' }
                });
            },
            complete: function() { 
                btn.prop('disabled', false).text('Save All Marks'); 
            }
        });
    });
});
</script>