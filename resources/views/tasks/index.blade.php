<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Tasks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.png">

    <!-- Responsive Table css -->
    <link href="/assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body data-sidebar="dark">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>


    <div class="modal fade" id="personalTaskModal" tabindex="-1" aria-labelledby="personalTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="personalTaskModalLabel">Create Personal Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row needs-validation" action="{{ route('tasks.store') }}" novalidate
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 position-relative">
                        <label class="form-label" for="validationCustom01">Task Subject</label>
                        <input type="text" name="title" class="form-control"
                            id="validationCustom01" placeholder="Enter Title " required />
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>



                    <div class="mb-3">
                        <label class="form-label">Priority</label>
                        <select name="priority" class="form-select">
                            <option value="" disabled selected>Select Status</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>

                        </select>
                    </div>


                    <div class="mb-3 position-relative">
                        <label class="form-label" for="validationCustom01">Task Category</label>
                        <select name="category_id" class="form-select" id="validationCustom01" required>
                            <option value="" disabled selected>Select Categories</option>
                            @foreach ($categories as $item)
                                @if ($item->type === 'Task')
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="" disabled selected>Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="in-progress">In-progress</option>
                            <option value="completed">Completed</option>
                            <option value="on-hold">On-Hold</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>

                    <div class="mb-3 position-relative">
                        <label class="form-label">Start Date</label>
                        <div>
                            <input name="start_date" data-parsley-type="number" type="date"
                                class="form-control" placeholder="Enter Due Date" required />
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label class="form-label">End Date</label>
                        <div>
                            <input name="end_date" data-parsley-type="number" type="date"
                                class="form-control" placeholder="Enter Due Date" required />
                        </div>
                    </div>


                    <div class="mb-3 position-relative">
                        <label class="form-label">Description </label>
                        <div>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div>
                            <button type="submit" class="btn btn-info waves-effect waves-light">
                                Save
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect ms-1">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>





    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm" class="row needs-validation" novalidate method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 position-relative">
                            <label class="form-label" for="editTaskTitle">Task Subject</label>
                            <input type="text" name="title" class="form-control" id="editTaskTitle" placeholder="Enter Title" required />
                            <div class="valid-tooltip">Looks good!</div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label class="form-label" for="editClient">Clients</label>
                            <select name="client_id" class="form-select" id="editClient" required>
                                <option value="" disabled selected>Select Client</option>
                                @foreach ($clients as $item)
                                    <option value="{{ $item->id }}">{{ $item->client_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Priority</label>
                            <select name="priority" class="form-select" id="editPriority">
                                <option value="" disabled selected>Select Priority</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>

                        <div class="mb-3 position-relative">
                            <label class="form-label" for="editEmployee">Assign To</label>
                            <select name="employee_id" class="form-select" id="editEmployee" required>
                                <option value="" disabled selected>Select Employee</option>
                                @foreach ($employee as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 position-relative">
                            <label class="form-label" for="editCategory">Task Category</label>
                            <select name="category_id" class="form-select" id="editCategory" required>
                                <option value="" disabled selected>Select Categories</option>
                                @foreach ($categories as $item)
                                    @if ($item->type === 'Task')
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" id="editStatus">
                                <option value="" disabled selected>Select Status</option>
                                <option value="pending">Pending</option>
                                <option value="in-progress">In-progress</option>
                                <option value="completed">Completed</option>
                                <option value="on-hold">On-Hold</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>

                        <div class="mb-3 position-relative">
                            <label class="form-label">Start Date</label>
                            <div>
                                <input name="start_date" type="date" class="form-control" id="editStartDate" required />
                            </div>
                        </div>
                        <div class="mb-3 position-relative">
                            <label class="form-label">End Date</label>
                            <div>
                                <input name="end_date" type="date" class="form-control" id="editEndDate" required />
                            </div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label class="form-label">Description</label>
                            <div>
                                <textarea name="description" class="form-control" rows="8" id="editDescription" required></textarea>
                            </div>
                        </div>

                        <div class="mb-0">
                            <div>
                                <button type="submit" class="btn btn-warning waves-effect waves-light">
                                    Update
                                </button>
                                <button type="button" class="btn btn-secondary waves-effect ms-1" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



<!-- Task Details Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="taskModalLabel">Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Title:</strong> <span id="modalTaskTitle"></span></li>
                    <li class="list-group-item"><strong>Description:</strong> <span id="modalTaskDescription"></span></li>
                    <li class="list-group-item"><strong>Priority:</strong> <span id="modalTaskPriority"></span></li>
                    <li class="list-group-item"><strong>Start Date:</strong> <span id="modalTaskStartDate"></span></li>
                    <li class="list-group-item"><strong>End Date:</strong> <span id="modalTaskEndDate"></span></li>
                    <li class="list-group-item"><strong>Status:</strong> <span id="modalTaskStatus"></span></li>
                    <li class="list-group-item"><strong>Assigned To:</strong> <span id="modalTaskEmployee"></span></li>
                    <li class="list-group-item"><strong>Category:</strong> <span id="modalTaskCategory"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteMinistryModal" tabindex="-1"
                        aria-labelledby="deleteMinistryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteMinistryModalLabel">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this Task?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form id="deleteMinistryForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

    @include('toast.success_toast')
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    <h4 class="card-title"><a class="btn btn-sm btn-info waves-effect waves-light"
                                            href="/windows/business_manager"><i class="dripicons-arrow-thin-left"></i></a>
                                            <a class="btn btn-info btn-sm waves-effect waves-light" href="/tasks/create"><i class="dripicons-plus"></i></a>
                                <a class="btn btn-info btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#personalTaskModal">Personal Task</a>


                                        </h4>
                                    {{-- <p class="card-title-desc"><b>{{$profileData->last_name}}</b>, this is the total Amount you have spent on all your projects</b></p> --}}


                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Task</th>
                                                        <th data-priority="3">Task Type</th>
                                                        <th data-priority="3">Task Assigned To</th>
                                                        <th data-priority="3">Status</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($tasks->isEmpty())
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Task Uploaded</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($tasks as $item)
                                                            <tr>
                                                                <td>
                                                                    <b>{{ $item->title }}</b><br>
                                                                    <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        Priority: {{ $item->priority }}
                                                                    </span>
                                                                </td>

                                                                <td>
                                                                    <b>{{ $item->category->name }}</b><br>
                                                                    <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        Client Name: {{ $item->client->client_name ?? 'N/A' }}

                                                                    </span>
                                                                </td>

                                                                <td>
                                                                    <b>{{ $item->worker->name ?? 'Self' }}</b><br>
                                                                    <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        Position: {{ $item->worker->designation ?? 'None' }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <b>{{ ucfirst($item->status) }}</b>
                                                                    <br>
                                                                    <span style="font-size: 11px; color: {{ \Carbon\Carbon::parse($item->end_date)->isToday() ? 'green' : 'rgb(112, 112, 112)' }};">
                                                                        Start Date: {{ \Carbon\Carbon::parse($item->start_date)->format('F j, Y') }} -
                                                                        End Date: {{ \Carbon\Carbon::parse($item->end_date)->format('F j, Y') }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <!-- Show button to open the modal -->
                                                                    <button type="button" class="btn btn-warning waves-effect waves-light" data-bs-toggle="modal"
                                                                    data-bs-target="#editTaskModal"
                                                                    data-slug="{{ $item->slug }}"
                                                                    data-title="{{ $item->title }}"
                                                                    data-client_id="{{ $item->client_id ?? 'Self'}}"
                                                                    data-priority="{{ $item->priority }}"
                                                                    data-employee_id="{{ $item->employee_id ?? 'Self' }}"
                                                                    data-category_id="{{ $item->category_id ?? 'Self'}}"
                                                                    data-status="{{ $item->status }}"
                                                                    data-start_date="{{ $item->start_date }}"
                                                                    data-end_date="{{ $item->end_date }}"
                                                                    data-description="{{ $item->description }}">
                                                                <i class="dripicons-document-edit"></i>
                                                            </button>


                                   <!-- Show button to open the modal -->
                                   <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal"
                                   data-bs-target="#taskModal"
                                   data-title="{{ $item->title }}"
                                   data-description="{{ $item->description }}"
                                   data-priority="{{ $item->priority }}"
                                   data-start_date="{{ $item->start_date }}"
                                   data-end_date="{{ $item->end_date }}"
                                   data-status="{{ $item->status }}"
                                   data-employee="{{ $item->employee->name ?? 'Self' }}"
                                   data-category="{{ $item->category->name  ?? 'Self'}}">
                               <i class="dripicons-preview"></i>
                           </button>


                                                                    <!-- Delete button -->
                                                                    <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                                                                            data-bs-target="#deleteMinistryModal" data-route="{{ route('tasks.destroy', $item->slug) }}">
                                                                        <i class="dripicons-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

           @include('includes.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <!-- Responsive Table js -->
    <script src="/assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

    <!-- Init js -->
    <script src="/assets/js/pages/table-responsive.init.js"></script>

    <script src="/assets/js/app.js"></script>

    <script>
        // Event listener for delete button click
        $('#deleteMinistryModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var route = button.data('route'); // Extract route from data-* attribute
            var modal = $(this);

            // Update the form action with the correct route
            modal.find('#deleteMinistryForm').attr('action', route);
        });
    </script>
    @include('toast.error_success_js')

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const taskModal = document.getElementById('taskModal');
    taskModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Fetch task details from data attributes
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');
        const priority = button.getAttribute('data-priority');
        const startDate = button.getAttribute('data-start_date');
        const endDate = button.getAttribute('data-end_date');
        const status = button.getAttribute('data-status');
        const employee = button.getAttribute('data-employee');
        const category = button.getAttribute('data-category');

        // Populate modal fields
        taskModal.querySelector('#modalTaskTitle').textContent = title;
        taskModal.querySelector('#modalTaskDescription').textContent = description;
        taskModal.querySelector('#modalTaskPriority').textContent = priority;
        taskModal.querySelector('#modalTaskStartDate').textContent = startDate;
        taskModal.querySelector('#modalTaskEndDate').textContent = endDate;
        taskModal.querySelector('#modalTaskStatus').textContent = status;
        taskModal.querySelector('#modalTaskEmployee').textContent = employee;
        taskModal.querySelector('#modalTaskCategory').textContent = category;
    });
});


    </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editTaskModal = document.getElementById('editTaskModal');
    editTaskModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Fetch task details from data attributes
        const slug = button.getAttribute('data-slug');
        const title = button.getAttribute('data-title');
        const clientId = button.getAttribute('data-client_id');
        const priority = button.getAttribute('data-priority');
        const employeeId = button.getAttribute('data-employee_id');
        const categoryId = button.getAttribute('data-category_id');
        const status = button.getAttribute('data-status');
        const startDate = button.getAttribute('data-start_date');
        const endDate = button.getAttribute('data-end_date');
        const description = button.getAttribute('data-description');

        // Populate the form with task data
        document.getElementById('editTaskTitle').value = title;
        document.getElementById('editClient').value = clientId;
        document.getElementById('editPriority').value = priority;
        document.getElementById('editEmployee').value = employeeId;
        document.getElementById('editCategory').value = categoryId;
        document.getElementById('editStatus').value = status;
        document.getElementById('editStartDate').value = startDate;
        document.getElementById('editEndDate').value = endDate;
        document.getElementById('editDescription').value = description;

        // Set the form action dynamically to include the slug
        const form = document.getElementById('editTaskForm');
        form.action = `/tasks/${slug}`;
    });
});

</script>
</body>

</html>
