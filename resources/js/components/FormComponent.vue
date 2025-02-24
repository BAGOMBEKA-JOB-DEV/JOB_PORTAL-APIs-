<template>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <div class="container mt-4">
    <h2 class="text-left">Create a Job Listing</h2>

    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" v-model="form.name" required />
        </div>
        <div class="col mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" v-model="form.email" />
        </div>
        <div class="col mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="number" class="form-control" id="phone" v-model="form.phone" />
        </div>
      </div>
      <button type="submit" class="btn btn-success">Create&nbsp;<i class="fa fa-plus-circle"></i></button>
    </form>

    <!-- Success Modal for Form Submission -->
    <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showSuccessModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Success</h5>
            <button type="button" class="btn-close" @click="showSuccessModal = false"></button>
          </div>
          <div class="modal-body">
            <p>Job Created successfully!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showSuccessModal = false">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Fail Modal for Form Submission -->
    <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showFailModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger">Failure!</h5>
            <button type="button" class="btn-close" @click="showFailModal = false"></button>
          </div>
          <div class="modal-body">
            <p>Error Creating job listing!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showFailModal = false">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Modal for Job Update -->
    <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showUpdateSuccessModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Success</h5>
            <button type="button" class="btn-close" @click="showUpdateSuccessModal = false"></button>
          </div>
          <div class="modal-body">
            <p>Job updated successfully!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showUpdateSuccessModal = false">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Modal for Job Delete -->
    <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="showDeleteSuccessModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Success</h5>
            <button type="button" class="btn-close" @click="showDeleteSuccessModal = false"></button>
          </div>
          <div class="modal-body">
            <p>Job Listing deleted successfully!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showDeleteSuccessModal = false">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- for importing jobs -->
    <div class="d-flex float-end">
      <div class="float-end">
        <button class="btn btn-success" @click="importFile = null; showImportModal = true">
          <i class="fas fa-file-import"></i> Import Jobs
        </button>
      </div>
      &nbsp;
      <!-- export button -->
      <div class="float-end">
        <button class="btn btn-success" @click="importFile = null; showImportModal = true">
          <i class="fas fa-file-excel"></i> Export Jobs
        </button>
      </div>
    </div>

    <!-- Import Modal -->
    <div class="modal" v-if="showImportModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Import Jobs</h5>
            <button type="button" class="btn-close" @click="showImportModal = false"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submitImport">
              <div class="mb-3">
                <i class="fa fa-file-excel p-2" aria-hidden="true"></i>
                <label for="file" class="form-label">Select an Excel or CSV File</label>
                <input type="file" class="form-control" id="file" @change="handleFileUpload" accept=".xlsx,.csv" required />
              </div>
              <button type="submit" class="btn btn-success">Import<i class="fa fa-arrow-circle-right p-2" aria-hidden="true"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Job List -->
    <div class="container mb-4">
      <h3 class="mt-4">Job Listings</h3>
      <table data-bs-theme="" class="table table-bordered mt-3">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="job in paginatedJobs" :key="job.id">
            <td>{{ job.id }}</td>
            <td>{{ job.name }}</td>
            <td>{{ job.email }}</td>
            <td>{{ job.phone }}</td>
            <td>
              <!-- Action buttons -->
              <button class="btn btn-success btn-sm me-2" @click="openViewModal(job)">
                <i class="fa fa-eye"></i> View
              </button>
              <button class="btn btn-secondary btn-sm me-2" @click="openEditModal(job)">
                <i class="fa fa-edit"></i> Edit
              </button>
              <button class="btn btn-danger btn-sm" @click="openDeleteModal(job)">
                <i class="fa fa-trash"></i> Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination Controls -->
      <nav>
        <ul class="pagination">
          <li class="page-item" :class="{ disabled: currentPage === 1 }">
            <button class="page-link" @click="changePage(currentPage - 1)">Previous</button>
          </li>
          <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: page === currentPage }">
            <button class="page-link" @click="changePage(page)">{{ page }}</button>
          </li>
          <li class="page-item" :class="{ disabled: currentPage === totalPages }">
            <button class="page-link" @click="changePage(currentPage + 1)">Next</button>
          </li>
        </ul>
      </nav>
    </div>

    <!-- View Modal -->
    <div data-bs-theme="dark" class="modal" tabindex="-1" v-if="viewModalOpen">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">View Job</h5>
            <button type="button" class="btn-close" @click="viewModalOpen = false"></button>
          </div>
          <div class="modal-body">
            <p><strong>Name:</strong> {{ selectedJob.name }}</p>
            <p><strong>Email:</strong> {{ selectedJob.email }}</p>
            <p><strong>Phone Number:</strong> {{ selectedJob.phone }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="viewModalOpen = false">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="editModalOpen">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Job</h5>
            <button type="button" class="btn-close" @click="editModalOpen = false"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" v-model="selectedJob.name" />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" v-model="selectedJob.email" />
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="number" class="form-control" v-model="selectedJob.phone" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="updateJob">Save Changes</button>
            <button type="button" class="btn btn-secondary" @click="editModalOpen = false">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Modal -->
    <div data-bs-theme="dark" class="modal text-light" tabindex="-1" v-if="deleteModalOpen">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Job</h5>
            <button type="button" class="btn-close" @click="deleteModalOpen = false"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this job?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="deleteJob">Delete</button>
            <button type="button" class="btn btn-secondary" @click="deleteModalOpen = false">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
      },
      jobs: [],
      selectedJob: {},
      showImportModal: false,
      showSuccessModal: false,
      showFailModal: false,
      showUpdateSuccessModal: false,
      showDeleteSuccessModal: false,
      viewModalOpen: false,
      editModalOpen: false,
      deleteModalOpen: false,
      currentPage: 1,
      jobsPerPage: 20,
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.jobs.length / this.jobsPerPage);
    },
    paginatedJobs() {
      const start = (this.currentPage - 1) * this.jobsPerPage;
      return this.jobs.slice(start, start + this.jobsPerPage);
    },
  },
  methods: {
    async submitForm() {
      try {
        await axios.post("/api/job", this.form);
        this.showSuccessModal = true;
        this.form = { name: "", email: "", phone: "" };
        this.fetchJobs();

        // Automatically hide the success modal after submitting the form
        setTimeout(() => {
          this.showSuccessModal = false;
        }, 10000); // 10 seconds
      } catch (error) {
        this.showFailModal = true;
        this.form = { name: "", email: "", phone: "" };
        console.error("Error submitting form:", error);

        // Automatically hide the fail modal after submitting a form
        setTimeout(() => {
          this.showFailModal = false;
        }, 10000); // 10 seconds
      }
    },

    // For fetching the data from the database
    async fetchJobs() {
      try {
        const response = await axios.get("/api/jobs");
        this.jobs = response.data;
      } catch (error) {
        console.error("Error fetching jobs:", error);
      }
    },
    changePage(page) {
      if (page < 1 || page > this.totalPages) return;
      this.currentPage = page;
    },
    openViewModal(job) {
      this.selectedJob = { ...job };
      this.viewModalOpen = true;
    },
    openEditModal(job) {
      this.selectedJob = { ...job };
      this.editModalOpen = true;
    },
    async updateJob() {
      try {
        await axios.put(`/api/job/${this.selectedJob.id}`, this.selectedJob);
        this.showUpdateSuccessModal = true;
        this.editModalOpen = false;
        this.fetchJobs();

        // Automatically make the update modal disappear after updating
        setTimeout(() => {
          this.showUpdateSuccessModal = false;
        }, 10000); // 10 seconds
      } catch (error) {
        console.error("Error updating job:", error);
      }
    },
    openDeleteModal(job) {
      this.selectedJob = { ...job };
      this.deleteModalOpen = true;
    },
    async deleteJob() {
      try {
        await axios.delete(`/api/job/${this.selectedJob.id}`);
        this.showDeleteSuccessModal = true;
        this.deleteModalOpen = false;
        this.fetchJobs();
        // Automatically make the delete success modal disappear
        setTimeout(() => {
          this.showDeleteSuccessModal = false;
        }, 10000); // 10 seconds
      } catch (error) {
        console.error("Error deleting job:", error);
      }
    },
  },
  created() {
    this.fetchJobs();
  },
};
</script>

<style scoped>
.modal {
  display: block; /* Ensure modals are displayed */
}
</style>