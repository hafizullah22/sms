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

<div class="container py-5">
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
                    <label class="form-label fw-bold">2. Select Subject</label>
                    <select id="subject_selector" class="form-select" disabled>
                        <option value="">-- Select Class First --</option>
                    </select>
                </div>
            </div>

            <div id="entry_area" style="display:none;">
                <hr>
                <form id="batchSaveForm">
                    <input type="hidden" name="class_id" id="hidden_class_id">
                    <input type="hidden" name="subject_id" id="hidden_subject_id">

                    <div class="table-responsive">
                        <table class="table table-hover table-v-align">
                            <thead class="table-dark">
                                <tr>
                                    <th width="100">Roll No</th>
                                    <th>Student Name</th>
                                    <th width="200">Marks Obtained</th>
                                </tr>
                            </thead>
                            <tbody id="student_list">
                                </tbody>
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

    // STEP 1: Load Students & Subjects
    $('#class_selector').change(function() {
        let classId = $(this).val();
        if(!classId) { $('#entry_area').hide(); return; }

        $.post("<?= site_url('result/get_data') ?>", {class_id: classId}, function(res) {
            let data = JSON.parse(res);
            $('#hidden_class_id').val(classId);
            
            // Fill Subjects
            let subHtml = '<option value="">-- Choose Subject --</option>';
            data.subjects.forEach(s => subHtml += `<option value="${s.id}">${s.subject_name}</option>`);
            $('#subject_selector').html(subHtml).prop('disabled', false);

            // Fill Students
            let stHtml = '';
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
            $('#student_list').html(stHtml);
            $('#entry_area').fadeIn();
        });
    });

    // STEP 2: Load Existing Marks when Subject is selected
    $('#subject_selector').change(function() {
        let subjectId = $(this).val();
        let classId = $('#hidden_class_id').val();
        $('#hidden_subject_id').val(subjectId);
        
        // Reset inputs
        $('.mark-input').val('');

        if(subjectId) {
            $.post("<?= site_url('result/get_existing_marks') ?>", {class_id: classId, subject_id: subjectId}, function(res) {
                let marks = JSON.parse(res);
                Object.keys(marks).forEach(studentId => {
                    $(`#mark_input_${studentId}`).val(marks[studentId]);
                });
            });
        }
    });

    // STEP 3: Manual Save Button Logic
    $('#batchSaveForm').on('submit', function(e) {
        e.preventDefault();
        
        let btn = $('#save_btn');
        btn.prop('disabled', true).text('Saving Data...');

        $.ajax({
            url: "<?= site_url('result/store_batch') ?>",
            type: "POST",
            data: $(this).serialize(),
            success: function(res) {
                let response = JSON.parse(res);
                if(response.status === 'success') {
                    Swal.fire('Saved!', response.message, 'success');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Server connection failed', 'error');
            },
            complete: function() {
                btn.prop('disabled', false).text('Save All Marks');
            }
        });
    });

    // Keyboard Navigation: Press Enter to move down
    $(document).on('keydown', '.mark-input', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            $(this).closest('tr').next().find('.mark-input').focus();
        }
    });
});
</script>

</body>
</html>