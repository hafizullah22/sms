<?php $this->load->view('layout/header'); ?>
      
      <!-- CONTENT -->
        <section class="content">

            <!-- CARDS -->
            <div class="row g-4 mb-4">

                <div class="col-md-6 col-xl-3">
                    <div class="dashboard-card">
                        <div class="icon bg-blue">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <h3>2,540</h3>
                        <p>Total Students</p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="dashboard-card">
                        <div class="icon bg-green">
                            <i class="bi bi-person-workspace"></i>
                        </div>

                        <h3>124</h3>
                        <p>Total Teachers</p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="dashboard-card">
                        <div class="icon bg-orange">
                            <i class="bi bi-building"></i>
                        </div>

                        <h3>18</h3>
                        <p>Total Classes</p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="dashboard-card">
                        <div class="icon bg-red">
                            <i class="bi bi-currency-dollar"></i>
                        </div>

                        <h3>$12,450</h3>
                        <p>Monthly Collection</p>
                    </div>
                </div>

            </div>


            <!-- TABLE -->
            <div class="custom-table">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Recent Students</h5>

                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i>
                        Add Student
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>#1001</td>
                                <td>Rahim Uddin</td>
                                <td>Class 10</td>
                                <td>017XXXXXXXX</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                            </tr>

                            <tr>
                                <td>#1002</td>
                                <td>Karim Hasan</td>
                                <td>Class 9</td>
                                <td>018XXXXXXXX</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                            </tr>

                            <tr>
                                <td>#1003</td>
                                <td>Nusrat Jahan</td>
                                <td>Class 8</td>
                                <td>019XXXXXXXX</td>
                                <td>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </section>



        <?php $this->load->view('layout/footer'); ?>


     