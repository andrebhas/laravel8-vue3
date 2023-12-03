<template>
    <section id="content" class="font-inter">
        <div class="sgx-title">
            <h1>Employee Database</h1>
        </div>
        <div class="sgx-stats">
            <div class="item">
                <div class="big-val">{{ this.employeeSummary.total }} <img src="../../../icons/chart-line-blue.svg" class="icon o10"></div>
                <div class="small-val font-size-11"><img src="../../../icons/users-dark.svg" class="inline-icon">Total Employees</div>
            </div>
            <div class="item">
                <div class="big-val text-success">{{ this.employeeSummary.active }}</div>
                <div class="small-val font-size-11"><img src="../../../icons/user-dark.svg" class="inline-icon">Active Employees</div>
            </div>
            <div class="item">
                <div class="big-val text-danger">{{ this.employeeSummary.inactive }}</div>
                <div class="small-val font-size-11"><img src="../../../icons/user-dark.svg" class="inline-icon">Inactive Employees</div>
            </div>
        </div>
        <div class="sgx-table alt">
            <div class="options no-scrollbar">
                <router-link :to="{ name: 'EmployeeRegister'}" class="item">Register</router-link>
                <a href="#" class="item" data-toggle="modal" @click="openModalSearch">
                    <img src="../../../icons/search-dark.svg" class="icon">Search
                </a>
            </div>
            <div class="info">
                <em><a href="#" @click="removeFilterSearch">Remove Filter</a></em>
            </div>
            <div class="table-wrapper no-scrollbar">
                <table class="table hoverable">
                  <thead>
                    <tr>
                        <th class="sgx-w-100">Name</th>
                        <th class="sgx-w-50">Status</th>
                        <th class="sgx-w-50">NIK</th>
                        <th class="sgx-w-50">Joined</th>
                        <th class="sgx-w-50">Srv Year</th>
                        <th class="sgx-w-50">Company</th>
                        <th class="sgx-w-100">Department</th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody v-if="this.employees.length > 0">
                    <tr
                        v-for="(employee, index) in this.employees"
                            :key="employee.id"
                        >

                        <td>
                            <div class="one-line text-nowrap d-block">
                                <img src="../../../img/initials/1_a.png" class="thumb s15 round">
                                <a href="#" data-toggle="modal" @click="openModalView(employee.id)" data-modifier="loading">{{ employee.name }}</a>
                            </div>
                        </td>
                        <td :class="{'text-center bg-light-blue': (employee.status == 1),  'text-center bg-light-red' : (employee.status == 0)}">{{ employee.status_name }}</td>
                        <td>{{ employee.nik }}</td>
                        <td>{{ employee.join_date }}</td>
                        <td>{{ employee.srv_time }}</td>
                        <td>{{ employee.company_name }}</td>
                        <td>{{ employee.department_name }}</td>
                        <td></td>
                    </tr>
                  </tbody>
                  <tbody v-else>
                    <tr>
                        <td colspan="7">Empty Data</td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div class="paginates text-right">
                <!-- <a href="#">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Next</a> -->
            </div>
        </div>
    </section>

    <section id="page-modals">
        <div class="modal anchor-modal" id="search-tray">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <img src="../../../img/modal-head.jpg">
                    </div>
                    <div class="modal-desc">
                        Employee Database Search
                    </div>
                    <div class="modal-body">
                        <form action="arrivals.php">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control hms-control hms-small first-focus" v-model="filterKeyword">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn hms-btn btn-light" @click="closeModalSearch">Close</button>
                        <button type="button" class="btn hms-btn btn-sea add-spinner white-spinner" @click="getEmployees()">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal anchor-modal" id="view-tray" :class="{'loading': isLoadDetailEmployee}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <img src="../../../img/modal-head.jpg">
                    </div>
                    <div class="modal-spinner">
                        <div class="spinner-contain"><div class="spinner-border"></div></div>
                    </div>
                    <div class="modal-body">
                        <div class="view-bg">
                            <!-- <div class="company-name">MBSS</div> -->
                            <!-- <div class="company-long">PT. Mitrabahtera Segara Sejati</div> -->
                            <img src="../../../img/curve1.svg" class="curve">
                        </div>
                        <div class="view-id mb-20">
                            <img src="https://lh3.googleusercontent.com/Oi2BFP9cVXQCxeKGezTqpJsplw7QpvHgiCgkhcTOVg9wfIQ_KQ1ccp__u-F4m-HShR7HE80Q_GRn4cz38DAQ8XdowkoCkiirByEpzQ=w286" class="thumb">
                            <div class="info">
                                <div class="big-title">{{ this.employeeDetail.name }}</div>
                                <div class="meta-title">{{ this.employeeDetail.company_name }} - {{ this.employeeDetail.department_name }} - {{this.employeeDetail.age }}</div>
                            </div>
                        </div>
                        <div class="text-center">
                            <!-- <div class="view-status active">Active</div> -->
                            <div class="view-status" :class="{'inactive': (this.employeeDetail.status  == 0), 'active' : (this.employeeDetail.status  == 1)}">{{this.employeeDetail.status_name }}</div>
                        </div>
                        <div class="pb-20"></div>
                        <div class="text-center">
                            <router-link :to="{ path: '/employee/' + this.employeeDetail.id}" class="btn hms-btn btn-sea add-spinner pop has-icon" data-dismiss="modal" @click="closeModalView">
                                <img src="../../../icons/search.svg" class="inline-icon">View Employee
                            </router-link>
                        </div>
                        <div class="pb-50"></div>
                        <div class="row no-gutters">
                            <div class="col-4 text-center">
                                <div class="view-pin mb-20">
                                    <div class="title">NIK</div>
                                    <div class="value">{{ this.employeeDetail.nik }}</div>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="view-pin mb-20">
                                    <div class="title">Service Year</div>
                                    <div class="value">{{ this.employeeDetail.srv_time }}</div>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="view-pin mb-20">
                                    <div class="title">Joined</div>
                                    <div class="value">{{ this.employeeDetail.join_date }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn hms-btn btn-light pop" data-dismiss="modal" @click="closeModalView">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { Modal } from 'bootstrap'
    import conf from '../../../js/constants.js'

    export default {
        data() {
            return {
                isLoadDetailEmployee: false,
                modalSearch: {},
                modalView: {},
                filterKeyword: '',
                employees: [],
                employeeId: null,
                employeeDetail: {},
                employeeSummary: {},
            }
        },
        async mounted() {
            this.modalSearch = new Modal('#search-tray', {})
            this.modalView = new Modal('#view-tray', {})
            this.getEmployeeSummary();
            this.getEmployees();
        },
        methods: {
            getEmployees() {
                this.axios.get(conf.API.EMPLOYEE, {
                    params: {
                        keyword: this.filterKeyword
                    }
                })
                .then(response => {
                    this.employees = response.data.original.data
                    this.closeModalSearch()
                    this.$forceUpdate()
                })
                .catch(function(error){
                    console.log(error)
                });
            },

            getEmployeeSummary() {
                this.axios.get(conf.API.EMPLOYEE_SUMMARY)
                .then(response => {
                    this.employeeSummary = response.data.data
                })
                .catch(function(error){
                    console.log(error)
                });
            },

            showEmployees() {
                this.axios.get(conf.API.EMPLOYEE + '/' +  this.employeeId)
                .then(response => {
                    this.isLoadDetailEmployee = false
                    this.employeeDetail = response.data.data
                })
                .catch(function(error){
                    console.log(error)
                });
            },

            openModalSearch() {
                this.modalSearch.show()
            },
            closeModalSearch() {
                this.modalSearch.hide()
            },
            removeFilterSearch() {
                this.filterKeyword = ''
                this.getEmployees()
            },

            openModalView(id) {
                this.employeeId = id
                this.isLoadDetailEmployee = true
                this.showEmployees()
                this.modalView.show()
            },
            closeModalView() {
                this.isLoadDetailEmployee = false
                this.modalView.hide()
            },

        }
    }
</script>
